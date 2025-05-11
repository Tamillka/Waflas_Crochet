<?php
require '../../assets/con_db.php';
if (isset($_POST['id'])) {
    $l_lietotajvards = htmlspecialchars($_POST['lietotajvards']);
    $l_vards = htmlspecialchars($_POST['vards']);
    $l_uzvards = htmlspecialchars($_POST['uzvards']);
    $l_epasts = htmlspecialchars($_POST['epasts']);
    $l_talrunis = htmlspecialchars($_POST['talrunis']);
    $l_loma = htmlspecialchars($_POST['loma']);
    $id = intval($_POST['id']);
    $paroleNew = $_POST['paroleNew'];
    if (!empty($paroleNew)) {
        $parole = password_hash($paroleNew, PASSWORD_DEFAULT);
        $sql = "UPDATE Waflas_lietotaji SET Lietotajvards = ?, Vards = ?, Uzvards = ?, Epasts = ?, Talrunis = ?, Loma = ?, Parole = ? WHERE Lietotajs_ID = ?";
        $vaicajums = $savienojums->prepare($sql);
        $vaicajums->bind_param("sssssssi", $l_lietotajvards, $l_vards, $l_uzvards, $l_epasts, $l_talrunis, $l_loma, $parole, $id);
    } else {
        $sql = "UPDATE Waflas_lietotaji SET Lietotajvards = ?, Vards = ?, Uzvards = ?, Epasts = ?, Talrunis = ?, Loma = ? WHERE Lietotajs_ID = ?";
        $vaicajums = $savienojums->prepare($sql);
        $vaicajums->bind_param("ssssssi", $l_lietotajvards, $l_vards, $l_uzvards, $l_epasts, $l_talrunis, $l_loma, $id);
    }

    if ($vaicajums->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Lietotāja informācija veiksmīgi rediģēta!',
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Kļūda rediģējot lietotāju: ' . $vaicajums->error,
        ]);
    }

    $vaicajums->close();
    $savienojums->close();
}
?>