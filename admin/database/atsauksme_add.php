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

$lastReviewDate = null;
$sql = "SELECT Piev_datums FROM waflas_atsauksmes WHERE id_lietotajs = ? ORDER BY Piev_datums DESC LIMIT 1";
$stmt = $savienojums->prepare($sql);
$stmt->bind_param("i", $id_lietotajs);
$stmt->execute();
$stmt->bind_result($lastReviewDate);
$stmt->fetch();
$stmt->close();

if ($lastReviewDate) {
    $sql = "SELECT COUNT(*) FROM waflas_pasutijumi WHERE id_lietotajs = ? AND Pasut_datums > ?";
    $stmt = $savienojums->prepare($sql);
    $stmt->bind_param("is", $id_lietotajs, $lastReviewDate);
} else {
    $sql = "SELECT COUNT(*) FROM waflas_pasutijumi WHERE id_lietotajs = ?";
    $stmt = $savienojums->prepare($sql);
    $stmt->bind_param("i", $id_lietotajs);
}
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count == 0) {
    $_SESSION['notif'] = ["text" => "Atsauksmi var pievienot tikai pēc jauna pasūtījuma.", "type" => "error"];
    header("Location: ../../atsauksmes.php");
    exit();
}

if ($vertejums < 1 || $vertejums > 5) {
    $_SESSION['notif'] = ["text" => "Vērtējumam jābūt no 1 līdz 5!", "type" => "error"];
    header("Location: ../../atsauksmes.php");
    exit();
}

if (!empty($teksts)) {
    $sql = "INSERT INTO waflas_atsauksmes (Zvaigznes_sk, Teksts, id_lietotajs) VALUES (?, ?, ?)";
    $stmt = $savienojums->prepare($sql);
    $stmt->bind_param("isi", $vertejums, $teksts, $id_lietotajs);

    if ($stmt->execute()) {
        $_SESSION['notif'] = ["text" => "Atsauksme veiksmīgi pievienota!", "type" => "success"];
    } else {
        $_SESSION['notif'] = ["text" => "Kļūda saglabājot atsauksmi: " . $savienojums->error, "type" => "error"];
    }
    $stmt->close();
}

$savienojums->close();
header("Location: ../../atsauksmes.php");
exit();
?>