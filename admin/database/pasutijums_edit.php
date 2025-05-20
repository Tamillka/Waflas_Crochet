<?php
require '../../assets/con_db.php';

if (isset($_POST['id'])) {
    $p_statuss = htmlspecialchars($_POST['statuss']);
    $id = intval($_POST['id']);

    $sql = "UPDATE Waflas_pasutijumi SET Statuss = ?, Izm_datums = NOW() WHERE Pasutijums_ID = ?";
    $vaicajums = $savienojums->prepare($sql);
    $vaicajums->bind_param("si", $p_statuss, $id);

    if ($vaicajums->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Lietotāja statuss veiksmīgi nomainīts!',
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Kļūda rediģējot pasūtījumu: ' . $vaicajums->error,
        ]);
    }

    $vaicajums->close();
    $savienojums->close();
}
?>