<?php
require '../../assets/con_db.php';
session_start();

if (isset($_POST['saglabat'])) {
    $vards = $_POST['vards'];
    $uzvards = $_POST['uzvards'];
    $epasts = $_POST['epasts'];
    $telefons = $_POST['telefons'];
    $valsts = $_POST['valsts'];
    $pilseta = $_POST['pilseta'];
    $adrese = $_POST['adrese'];

    $lietotajs_id = $_SESSION['lietotajs_id'] ?? null;

    if (!$lietotajs_id) {
        die("Nav atrasts lietotāja ID.");
    }

    $summa = 0;
    $cart_query = $savienojums->prepare("
        SELECT g.id_prece, g.Daudzums, p.Cena
        FROM waflas_grozs g
        JOIN waflas_preces p ON g.id_prece = p.Preces_ID
        WHERE g.id_lietotajs = ?
    ");
    $cart_query->bind_param("i", $lietotajs_id);
    $cart_query->execute();
    $result = $cart_query->get_result();
    $preces = [];

    while ($row = $result->fetch_assoc()) {
        $preces[] = $row;
        $summa += $row['Daudzums'] * $row['Cena'];
    }

    if (empty($preces)) {
        die("Jūsu grozs ir tukšs.");
    }

    $stmt = $savienojums->prepare("
        INSERT INTO waflas_pasutijumi (id_lietotajs, Summa, Vards, Uzvards, Epasts, Talrunis, Valsts, Pilseta, Adrese)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("idsssssss", $lietotajs_id, $summa, $vards, $uzvards, $epasts, $telefons, $valsts, $pilseta, $adrese);
    $stmt->execute();
    $pasutijums_id = $stmt->insert_id;

    $stmt_detail = $savienojums->prepare("
        INSERT INTO pasutijuma_sastavdalas (id_pasutijums, id_prece, Vienibas_sk, Vienibu_kopeja_cena)
        VALUES (?, ?, ?, ?)
    ");

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

    // header("Location: ./");
    $_SESSION['pasutijums_id'] = $pasutijums_id;
    exit();
}
?>