<?php
require '../assets/con_db.php';
require_once '../vendor/stripe-php-master/init.php';
require_once 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_order'])) {
    $vards = $_POST['vards'];
    $uzvards = $_POST['uzvards'];
    $epasts = $_POST['epasts'];
    $telefons = $_POST['telefons'];
    $pilseta = $_POST['pilseta'];
    $adrese = $_POST['adrese'];
    $pakomats = $_POST['omniva_terminal'];

    $lietotajs_id = $_SESSION['lietotajs_id'] ?? null;
    if (!$lietotajs_id) {
        die("Nav atrasts lietotāja ID.");
    }

    $cart_query = $savienojums->prepare("
        SELECT g.id_prece, g.Daudzums, p.Nosaukums, p.Cena
        FROM waflas_grozs g
        JOIN waflas_preces p ON g.id_prece = p.Preces_ID
        WHERE g.id_lietotajs = ?
    ");
    $cart_query->bind_param("i", $lietotajs_id);
    $cart_query->execute();
    $result = $cart_query->get_result();

    $preces = [];
    $summa = 0;

    while ($row = $result->fetch_assoc()) {
        $preces[] = $row;
        $summa += $row['Daudzums'] * $row['Cena'];
    }

    if (empty($preces)) {
        die("Grozs ir tukšs.");
    }

    $stmt = $savienojums->prepare("INSERT INTO waflas_pasutijumi (id_lietotajs, Summa, Vards, Uzvards, Epasts, Talrunis, Pilseta, Adrese, Pakomats) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("idsssssss", $lietotajs_id, $summa, $vards, $uzvards, $epasts, $telefons, $pilseta, $adrese, $pakomats);
    $stmt->execute();
    $pasutijums_id = $stmt->insert_id;

    $stmt_detail = $savienojums->prepare("INSERT INTO pasutijuma_sastavdalas (id_pasutijums, id_prece, Vienibas_sk, Vienibu_kopeja_cena) VALUES (?, ?, ?, ?)");
    foreach ($preces as $prece) {
        $id_prece = $prece['id_prece'];
        $vienibas_sk = $prece['Daudzums'];
        $kopeja = $vienibas_sk * $prece['Cena'];
        $stmt_detail->bind_param("iiid", $pasutijums_id, $id_prece, $vienibas_sk, $kopeja);
        $stmt_detail->execute();
    }

    $clear_stmt = $savienojums->prepare("DELETE FROM waflas_grozs WHERE id_lietotajs = ?");
    $clear_stmt->bind_param("i", $lietotajs_id);
    $clear_stmt->execute();

    $_SESSION['pasutijums_id'] = $pasutijums_id;

    $line_items = [];
    foreach ($preces as $item) {
        $line_items[] = [
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => intval($item['Cena'] * 100),
                'product_data' => [
                    'name' => $item['Nosaukums'],
                ],
            ],
            'quantity' => $item['Daudzums'],
        ];
    }

    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $line_items,
        'mode' => 'payment',
        'success_url' => 'http://localhost/payment/success.php?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://localhost/grozs.php',
        'locale' => 'lv',
    ]);

    header("Location: " . $checkout_session->url);
    exit();
}
?>