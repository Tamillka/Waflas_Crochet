<?php
session_start();
require "../../assets/con_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['bilde'])) {

    $id = $_SESSION['lietotajs_id'];
    $imageData = file_get_contents($_FILES['bilde']['tmp_name']);

    $sql = "UPDATE Waflas_lietotaji SET Bilde = ? WHERE Lietotajs_ID = ?";
    $vaicajums = $savienojums->prepare($sql);
    $vaicajums->bind_param("bi", $null, $id);
    $vaicajums->send_long_data(0, $imageData);

    if ($vaicajums->execute()) {
        $_SESSION['notif'] = "Profila bilde veiksmīgi atjaunināta!";
    } else {
        $_SESSION['notif'] = "Kļūda augšupielādējot attēlu: " . $savienojums->error;
    }

    $vaicajums->close();
    $savienojums->close();

    header("Location: ../../iestatijumi.php");
    exit();
}


if (isset($_POST['rediget'])) {
    $vards = htmlspecialchars($_POST['vards']);
    $uzvards = htmlspecialchars($_POST['uzvards']);
    $lietotajvards = htmlspecialchars($_POST['lietotajvards']);
    $epasts = htmlspecialchars($_POST['epasts']);
    $talrunis = htmlspecialchars($_POST['telefons']);
    $id = $_SESSION['lietotajs_id'];


    $sql = "UPDATE Waflas_lietotaji SET Vards = ?, Uzvards = ?, Lietotajvards = ?, Epasts = ?, Talrunis = ? WHERE Lietotajs_ID = ?";
    $vaicajums = $savienojums->prepare($sql);
    $vaicajums->bind_param("sssssi", $vards, $uzvards, $lietotajvards, $epasts, $talrunis, $id);

    if ($vaicajums->execute()) {
        $_SESSION['notif'] = "Dati veiksmīgi saglabāti!";
    } else {
        $_SESSION['notif'] = "Kļūda saglabājot datus: " . $savienojums->error;
    }

    $vaicajums->close();
    $savienojums->close();

    header("Location: ../../iestatijumi.php"); // <-- Измени на фактический путь
    exit();
}

// Paroles maiņa:
if (isset($_POST['change_password'])) {
    $id = $_SESSION['lietotajs_id'];
    $currentPassword = $_POST['currentpassword'];
    $newPassword = $_POST['jauna'];
    $confirmNewPassword = $_POST['jaunaatkartoti'];

    $sql = "SELECT Parole FROM Waflas_lietotaji WHERE Lietotajs_ID = ?";
    $vaicajums = $savienojums->prepare($sql);
    $vaicajums->bind_param("i", $id);
    $vaicajums->execute();
    $rezultats = $vaicajums->get_result();

    if ($rezultats->num_rows === 1) {
        $user = $rezultats->fetch_assoc();

        if (password_verify($currentPassword, $user['Parole'])) {
            if ($newPassword === $confirmNewPassword) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $updateSql = "UPDATE Waflas_lietotaji SET Parole = ? WHERE Lietotajs_ID = ?";
                $updateStmt = $savienojums->prepare($updateSql);
                $updateStmt->bind_param("si", $hashedPassword, $id);

                if ($updateStmt->execute()) {
                    $_SESSION['notif'] = "Parole veiksmīgi nomainīta!";
                } else {
                    $_SESSION['notif'] = "Kļūda mainot paroli: " . $savienojums->error;
                }

                $updateStmt->close();
            } else {
                $_SESSION['notif'] = ["text" => "Jaunās paroles nesakrīt!", "type" => "error"];
            }
        } else {
            $_SESSION['notif'] = ["text" => "Nepareiza pašreizējā parole!", "type" => "error"];
        }
    }

    $vaicajums->close();
    $savienojums->close();

    header("Location: ../../iestatijumi.php");
    exit();
}
?>