<?php
require '../../assets/con_db.php';
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $del = 0;

    $sql = "UPDATE Waflas_kategorija SET Radits = ? WHERE Kategorijas_ID = ?";
    $vaicajums = $savienojums->prepare($sql);
    $vaicajums->bind_param("ii", $del, $id);

    if ($vaicajums->execute()) {
        // echo "Veiksmgi dzēsts!";
    } else {
        // echo "Kļūda! ".$savienojums->error;
    }

    $vaicajums->close();
    $savienojums->close();
}


?>