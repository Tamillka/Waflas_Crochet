<?php
require __DIR__ . '/../../assets/con_db.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$lietotajs_id = $_SESSION['lietotajs_id'];

// Получаем заказы пользователя с общей суммой и количеством товаров
$vaicajums = "
SELECT 
    p.Pasutijums_ID,
    p.Pasut_datums,
    p.Statuss,
    SUM(s.Vienibu_kopeja_cena) AS Kop_summ,
    SUM(s.Vienibas_sk) AS Precu_daudzums
FROM waflas_pasutijumi AS p
JOIN pasutijuma_sastavdalas AS s ON p.Pasutijums_ID = s.id_pasutijums
WHERE p.id_lietotajs = ?
GROUP BY p.Pasutijums_ID
ORDER BY p.Pasutijums_ID DESC
";
$stmt = $savienojums->prepare($vaicajums);
$stmt->bind_param("i", $lietotajs_id);
$stmt->execute();
$rezultats = $stmt->get_result();

$visi_pasutijumi = [];

while ($rinda = $rezultats->fetch_assoc()) {
    $pasutijums_id = $rinda['Pasutijums_ID'];

    // Получаем список товаров для этого заказа
    $produktiSQL = "
    SELECT 
        pr.Nosaukums,
        pr.Bilde1,
        s.Vienibas_sk,
        s.Vienibu_kopeja_cena
    FROM pasutijuma_sastavdalas AS s
    JOIN waflas_preces AS pr ON s.id_prece = pr.Preces_ID
    WHERE s.id_pasutijums = ?
    ";
    $stmt2 = $savienojums->prepare($produktiSQL);
    $stmt2->bind_param("i", $pasutijums_id);
    $stmt2->execute();
    $produktiRez = $stmt2->get_result();

    $produkti = [];
    while ($prece = $produktiRez->fetch_assoc()) {
        // Кодируем изображение
        $imageSrc = !empty($prece['Bilde1'])
            ? "data:image/jpeg;base64," . base64_encode($prece['Bilde1'])
            : "/images/default_product.png";

        $produkti[] = [
            'nosaukums' => $prece['Nosaukums'],
            'bilde' => $imageSrc,
            'vienibas_sk' => $prece['Vienibas_sk'],
            'kopeja_cena' => $prece['Vienibu_kopeja_cena'],
        ];
    }

    $visi_pasutijumi[] = [
        'id' => $pasutijums_id,
        'datums' => date("d.m.Y", strtotime($rinda['Pasut_datums'])),
        'statuss' => $rinda['Statuss'],
        'summa' => $rinda['Kop_summ'],
        'daudzums' => $rinda['Precu_daudzums'],
        'produkti' => $produkti
    ];
}
?>