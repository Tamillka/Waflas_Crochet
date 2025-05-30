<?php
require __DIR__ . '/../../assets/con_db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$total = 0.00;

if (isset($_SESSION['lietotajs_id'])) {
    $lietotajs_id = $_SESSION['lietotajs_id'];

    $sql = "
    SELECT p.Cena, g.Daudzums 
    FROM Waflas_grozs g
    JOIN Waflas_preces p ON g.id_prece = p.Preces_ID
    WHERE g.id_lietotajs = ?
";

    $stmt = $savienojums->prepare($sql);
    $stmt->bind_param("i", $lietotajs_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $total += $row['Cena'] * $row['Daudzums'];
    }
}
?>