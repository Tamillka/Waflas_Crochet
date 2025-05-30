<?php
require '../../assets/con_db.php';
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $del = 0;

    $sql = "UPDATE Waflas_kategorija SET Radits = ? WHERE Kategorijas_ID = ?";
    $vaicajums = $savienojums->prepare($sql);
    $vaicajums->bind_param("ii", $del, $id);

    if ($vaicajums->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Kategorija veiksmīgi dzēsta!',
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