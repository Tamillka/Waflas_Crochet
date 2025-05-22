<?php
require '../../assets/con_db.php';
session_start();

if (!isset($_SESSION['lietotajs_id'])) {
    $_SESSION['notif'] = ["text" => "Tikai autorizēts lietotājs var pievienot atsauksmi!", "type" => "error"];
    header("Location: ../../atsauksmes.php");
    exit();
}

$id_lietotajs = $_SESSION['lietotajs_id'];
$teksts = htmlspecialchars($_POST['teksts']);
$vertejums = intval($_POST['vertejums']);

$check_sql = "SELECT COUNT(*) FROM waflas_pasutijumi WHERE id_lietotajs = ?";
$check = $savienojums->prepare($check_sql);
$check->bind_param("i", $id_lietotajs);
$check->execute();
$check->bind_result($order_count);
$check->fetch();
$check->close();

if ($order_count == 0) {
    $_SESSION['notif'] = ["text" => "Jums nav iespējas pievienot atsauksmi!", "type" => "error"];
    header("Location: ../../atsauksmes.php");
    exit();
}

if ($vertejums < 1 || $vertejums > 5) {
    $_SESSION['notif'] = ["text" => "Vērtējumam jābūt no 1 līdz 5.", "type" => "error"];
    header("Location: ../../atsauksmes.php");
    exit();
}

$sql = "INSERT INTO waflas_atsauksmes (Zvaigznes_sk, Teksts, id_lietotajs) VALUES (?, ?, ?)";
$vaicajums = $savienojums->prepare($sql);
$vaicajums->bind_param("isi", $vertejums, $teksts, $id_lietotajs);

if ($vaicajums->execute()) {
    $_SESSION['notif'] = "Atsauksme veiksmīgi pievienota!";
} else {
    $_SESSION['notif'] = "Kļūda saglabājot datus: " . $savienojums->error;
}

$vaicajums->close();
$savienojums->close();

header("Location: ../../atsauksmes.php");
exit();
?>