<?php
require '../../assets/con_db.php';

$vaicajums = "SELECT COUNT(*) AS skaits FROM waflas_pasutijumi WHERE Statuss = 'Jauns'";
$rezultats = mysqli_query($savienojums, $vaicajums);

$skaits = 0;
if ($rezultats && $ieraksts = mysqli_fetch_assoc($rezultats)) {
    $skaits = (int) $ieraksts['skaits'];
}

echo json_encode(['jaunie' => $skaits]);
?>