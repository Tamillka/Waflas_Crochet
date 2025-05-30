<?php
require '../../assets/con_db.php';
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $del = 0;

    $sql = "UPDATE Waflas_preces SET Radits = ? WHERE Preces_ID = ?";
    $vaicajums = $savienojums->prepare($sql);
    $vaicajums->bind_param("ii", $del, $id);

    if ($vaicajums->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Prece veiksmīgi dzēsta!',
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Kļūda sistēmā!',
        ]);
    }

    $vaicajums->close();
    $savienojums->close();
}


?>