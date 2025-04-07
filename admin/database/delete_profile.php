<?php
session_start();
require '../../assets/con_db.php';

if (isset($_POST['dzest'])) {
    $id = $_SESSION['lietotajs_id'];
    $del = 0;

    $sql = "UPDATE Waflas_lietotaji SET Radits = ? WHERE Lietotajs_ID = ?";
    $vaicajums = $savienojums->prepare($sql);
    $vaicajums->bind_param("ii", $del, $id);
    $vaicajums->execute();
    $vaicajums->close();
    $savienojums->close();

    session_unset();
    session_destroy();

    exit();
}
?>