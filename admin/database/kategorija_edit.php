<?php
require '../../assets/con_db.php';

if (isset($_POST['id'])) {
    $p_nosaukums = htmlspecialchars($_POST['nosaukums']);
    $id = intval($_POST['id']);

    // Pirmais vaicājums, lai iegūtu esošo bildi
    $sql = "SELECT Bilde FROM Waflas_kategorija WHERE Kategorijas_ID = ?";
    $vaicajums = $savienojums->prepare($sql);
    $vaicajums->bind_param("i", $id);
    $vaicajums->execute();
    $rezultats = $vaicajums->get_result();

    $ieraksts = $rezultats->fetch_assoc();
    $current_bilde = $ieraksts['Bilde'];
    $p_bilde = $current_bilde;

    if (isset($_FILES['bilde']) && $_FILES['bilde']['error'] === UPLOAD_ERR_OK) {
        $p_bilde = file_get_contents($_FILES['bilde']['tmp_name']);
    }

    $sql_update = "UPDATE Waflas_kategorija
                   SET Nosaukums = ?, Bilde = ?, Izm_datums = NOW() 
                   WHERE Kategorijas_ID = ?";
    $vaicajums_update = $savienojums->prepare($sql_update);
    $vaicajums_update->bind_param("ssi", $p_nosaukums, $p_bilde, $id);

    if ($vaicajums_update->execute()) {
        echo json_encode(["success" => true, "message" => "Kategorija veiksmīgi rediģēta!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Kļūda sistēmā!"]);
    }

    $vaicajums_update->close();
    $vaicajums->close();
    $savienojums->close();
}
?>