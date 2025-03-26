<?php
require "assets/con_db.php";
session_start();

if (!isset($_SESSION['lietotajs_id'])) {
    echo json_encode(['success' => false, 'message' => 'Lietotājs nav autorizēts sistēmā.']);
    exit;
}

$id_lietotajs = $_SESSION['lietotajs_id'];
$id_prece = isset($_POST['id_prece']) ? intval($_POST['id_prece']) : 0;

if ($id_prece <= 0) {
    echo json_encode(['success' => false, 'message' => 'Nepareizs preces ID.']);
    exit;
}

$sql = "INSERT INTO Waflas_grozs (id_prece, id_lietotajs) VALUES (?, ?)";
$stmt = $savienojums->prepare($sql);
$stmt->bind_param("ii", $id_prece, $id_lietotajs);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Prece pievienota grozam!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Kļūda pievienojot preci grozam.']);
}

$stmt->close();
?>