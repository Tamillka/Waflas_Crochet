<?php
require '../../assets/con_db.php';
if (isset($_POST['id'])) {
    $id = htmlspecialchars($_POST['id']);
    $vaicajums = $savienojums->prepare("SELECT * FROM Waflas_kategorija WHERE Kategorijas_ID = ?");

    $vaicajums->bind_param("i", $id);
    $vaicajums->execute();
    $rezultats = $vaicajums->get_result();
    if (!$rezultats) {
        die('Kļūda! ' . $savienojums->error);
    }

    while ($ieraksts = $rezultats->fetch_assoc()) {
        $json[] = array(
            'id' => htmlspecialchars($ieraksts['Kategorijas_ID']),
            'nosaukums' => htmlspecialchars($ieraksts['Nosaukums']),
            'datums' => date("d.m.Y. H:i", strtotime($ieraksts['Piev_datums'])),
            'redigesanas_datums' => date("d.m.Y. H:i", strtotime($ieraksts['Izm_datums'])),
        );
    }

    $vaicajums->close();
    $savienojums->close();

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
?>