<?php
require 'assets/con_db.php';
header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $vaicajums = $savienojums->prepare("DELETE FROM waflas_grozs WHERE Grozs_ID = ?");
    $vaicajums->bind_param("i", $id);

    if ($vaicajums->execute()) {
        echo json_encode(["success" => true, "message" => "Prece veiksmīgi dzēsta no groza"]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Kļūda dzēšanā: ' . $savienojums->error]);
    }

    $vaicajums->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Nav saņemts ID.']);
}

$savienojums->close();
?>