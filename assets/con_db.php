<?php
$serveris = "localhost";
$lietotajs = "grobina1_matjasa";
$parole = "tYwWu!zHo";
$db_nosaukums = "grobina1_matjasa";

$savienojums = mysqli_connect($serveris, $lietotajs, $parole, $db_nosaukums);

if (!$savienojums) {
    #die("Kļūda ar datu bāzi: ".mysqli_connect_error());
} else {
    #echo "Savienojums veiksmīgi izveidots!";
}
?>