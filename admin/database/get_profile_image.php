<?php
session_start();
require "../../assets/con_db.php";

$id = $_SESSION['lietotajs_id'];

$vaicajums = $savienojums->prepare("SELECT Bilde FROM Waflas_lietotaji WHERE Lietotajs_ID = ?");
$vaicajums->bind_param("i", $id);
$vaicajums->execute();
$rezultats = $vaicajums->get_result();

if ($rezultats->num_rows > 0) {
    $row = $rezultats->fetch_assoc();
    $foto = $row['Bilde'];

    if (!empty($foto)) {
        header("Content-Type: image/jpeg");
        echo $foto;
        exit();
    }
}

$defaultPath = "../../images/profile.png";

if (file_exists($defaultPath)) {
    header("Content-Type: image/png");
    readfile($defaultPath);
    exit();
} else {
    http_response_code(404);
    echo "Nav attēla";
    exit();
}