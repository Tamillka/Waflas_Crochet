<?php
require 'assets/con_db.php';
session_start();

$lietotajs_id = $_SESSION['lietotajs_id'];
$grozs_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$daudzums = isset($_POST['daudzums']) ? intval($_POST['daudzums']) : 1;


$sql = "UPDATE waflas_grozs SET Daudzums = ? WHERE Grozs_ID = ? AND id_lietotajs = ?";
$stmt = $savienojums->prepare($sql);
$stmt->bind_param("iii", $daudzums, $grozs_id, $lietotajs_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Neizdevās saglabāt']);
}

$stmt->close();
?>