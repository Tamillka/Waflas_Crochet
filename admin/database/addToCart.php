<?php
// Ielādē datubāzes savienojuma failu un sāk sesiju
require '../../assets/con_db.php';
session_start();

// Norāda, ka atbildes saturs būs JSON formātā
header('Content-Type: application/json');

// Pārbauda, vai lietotājs ir autorizēts (sesijā ir ID)
if (!isset($_SESSION['lietotajs_id'])) {
    echo json_encode(["success" => false, "message" => "Lietotājs nav autorizēts!"]);
    exit;
}

$id_lietotajs = $_SESSION['lietotajs_id'];
$id_prece = isset($_POST['id_prece']) ? intval($_POST['id_prece']) : 0;

// Pārbauda, vai šī prece jau ir lietotāja grozā
$sql_check = "SELECT Daudzums FROM Waflas_grozs WHERE id_prece = ? AND id_lietotajs = ?";
$stmt_check = $savienojums->prepare($sql_check);
$stmt_check->bind_param("ii", $id_prece, $id_lietotajs);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    // Ja prece jau ir grozā, palielina tās daudzumu par 1
    $sql_update = "UPDATE Waflas_grozs SET Daudzums = Daudzums + 1 WHERE id_prece = ? AND id_lietotajs = ?";
    $stmt_update = $savienojums->prepare($sql_update);
    $stmt_update->bind_param("ii", $id_prece, $id_lietotajs);
    $stmt_update->execute();
    echo json_encode(["success" => true, "message" => "Prece veiksmīgi pievienota grozam!"]);
    exit;
} else {
    // Ja prece vēl nav grozā, pievieno to ar daudzumu 1
    $sql = "INSERT INTO Waflas_grozs (id_prece, id_lietotajs, Daudzums) VALUES (?, ?, 1)";
    $stmt = $savienojums->prepare($sql);
    $stmt->bind_param("ii", $id_prece, $id_lietotajs);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Prece veiksmīgi pievienota grozam!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Kļūda, pievienojot preci grozam."]);
    }
    exit;
}
?>