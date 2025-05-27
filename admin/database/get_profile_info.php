<?php
require __DIR__ . '/../../assets/con_db.php';

if (!isset($_SESSION['lietotajs_id'])) {
    return;
}

$lietotajs_id = $_SESSION['lietotajs_id'];

$sql = "SELECT Lietotajvards FROM waflas_lietotaji WHERE Lietotajs_ID = ?";
$stmt = $savienojums->prepare($sql);
$stmt->bind_param("i", $lietotajs_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $lietotajvards = htmlspecialchars($row['Lietotajvards']);
} else {
    $lietotajvards = "Undefined";
}