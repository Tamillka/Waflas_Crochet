<?php
require '../../assets/con_db.php';

$id = $_GET['id'];
$index = $_GET['index']; // 1, 2, 3

$col = "Bilde" . intval($index);
$sql = $savienojums->prepare("SELECT $col FROM Waflas_preces WHERE Preces_ID = ?");
$sql->bind_param("i", $id);
$sql->execute();
$sql->store_result();
$sql->bind_result($image);
$sql->fetch();

if ($image) {
    header("Content-Type: image/jpeg");
    echo $image;
}
?>