<?php
require "assets/con_db.php";
session_start();

if (!isset($_SESSION['lietotajs_id'])) {
    $_SESSION['pazinojums'] = "Lietotājs nav autorizēts!";
    exit;
}

$id_lietotajs = $_SESSION['lietotajs_id'];
$id_prece = isset($_POST['id_prece']) ? intval($_POST['id_prece']) : 0;


$sql_check = "SELECT Daudzums FROM Waflas_grozs WHERE id_prece = ? AND id_lietotajs = ?";
$stmt_check = $savienojums->prepare($sql_check);
$stmt_check->bind_param("ii", $id_prece, $id_lietotajs);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    $sql_update = "UPDATE Waflas_grozs SET Daudzums = Daudzums + 1 WHERE id_prece = ? AND id_lietotajs = ?";
    $stmt_update = $savienojums->prepare($sql_update);
    $stmt_update->bind_param("ii", $id_prece, $id_lietotajs);
    $stmt_update->execute();
} else {
    $sql = "INSERT INTO Waflas_grozs (id_prece, id_lietotajs, Daudzums) VALUES (?, ?, 1)";
    $stmt = $savienojums->prepare($sql);
    $stmt->bind_param("ii", $id_prece, $id_lietotajs);

    if ($stmt->execute()) {
        $_SESSION['pazinojums'] = "Prece veiksmīgi pievienota grozam!";
    } else {
        $_SESSION['pazinojums'] = "Notika kļūda, pievienojot preci grozam!";
    }
}



$stmt->close();
?>