<?php
require '../../assets/con_db.php';
if (isset($_POST['id'])) {
    $id = htmlspecialchars($_POST['id']);
    $vaicajums = $savienojums->prepare("SELECT * FROM Waflas_lietotaji WHERE Lietotajs_ID = ?");

    $vaicajums->bind_param("i", $id);
    $vaicajums->execute();
    $rezultats = $vaicajums->get_result();
    if (!$rezultats) {
        die('Kļūda! ' . $savienojums->error);
    }

    while ($ieraksts = $rezultats->fetch_assoc()) {
        $json[] = array(
            'id' => htmlspecialchars($ieraksts['Lietotajs_ID']),
            'lietotajvards' => htmlspecialchars($ieraksts['Lietotajvards']),
            'vards' => htmlspecialchars($ieraksts['Vards']),
            'uzvards' => htmlspecialchars($ieraksts['Uzvards']),
            'epasts' => htmlspecialchars($ieraksts['Epasts']),
            'talrunis' => htmlspecialchars($ieraksts['Talrunis']),
            'loma' => htmlspecialchars($ieraksts['Loma']),
            'datums' => date("d.m.Y. H:i", strtotime($ieraksts['Piev_datums'])),
        );
    }

    $vaicajums->close();
    $savienojums->close();

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
?>