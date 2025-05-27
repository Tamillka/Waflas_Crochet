<?php
require __DIR__ . '/../../assets/con_db.php';
$statsSQL = "SELECT COUNT(*) AS daudzums, ROUND(AVG(Zvaigznes_sk), 1) AS videjais FROM waflas_atsauksmes";
$rezultats = mysqli_query($savienojums, $statsSQL);

$videjais = 0;
$daudzums = 0;

if ($rezultats && mysqli_num_rows($rezultats) > 0) {
    $rinda = mysqli_fetch_assoc($rezultats);
    $videjais = number_format((float) $rinda['videjais'], 1);
    $daudzums = (int) $rinda['daudzums'];
}

$zvaigznesHTML = '';
$pilnas = round($videjais);
for ($i = 1; $i <= 5; $i++) {
    $zvaigznesHTML .= $i <= $pilnas
        ? '<i class="fa-solid fa-star"></i>'
        : '<i class="fa-regular fa-star"></i>';
}
?>