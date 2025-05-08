<?php
require '../../assets/con_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nosaukums = htmlspecialchars($_POST['nosaukums']);
    $bilde = null;

    if (isset($_FILES['bilde']) && $_FILES['bilde']['error'] === UPLOAD_ERR_OK) {
        $bilde = file_get_contents($_FILES['bilde']['tmp_name']);
    }

    if (!empty($nosaukums) && !empty($bilde)) {
        $stmt = $savienojums->prepare("INSERT INTO Waflas_kategorija (Nosaukums, Bilde) VALUES (?, ?)");
        $stmt->bind_param("ss", $nosaukums, $bilde);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Jauna kategrija veiksmīgi pievienota!"]);
        } else {
            // $_SESSION['pazinojums1'] = "Kļūda: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // $_SESSION['pazinojums1'] = "Visi ievades lauki nav aizpildīti!";
    }

}

?>