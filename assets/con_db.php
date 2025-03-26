<?php
$serveris = "localhost";
$lietotajs = "root";
$parole = "";
$db_nosaukums = "Waflas_crochetDB";

$savienojums = mysqli_connect($serveris, $lietotajs, $parole, $db_nosaukums);

if (!$savienojums) {
    #die("Kļūda ar datu bāzi: ".mysqli_connect_error());
} else {
    #echo "Savienojums veiksmīgi izveidots!";
}
?>