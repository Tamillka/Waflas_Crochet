<?php

require '../../assets/con_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nosaukums = htmlspecialchars($_POST['nosaukums']);
    $materials = htmlspecialchars($_POST['materials']);
    $apraksts = htmlspecialchars($_POST['apraksts']);
    $cena = htmlspecialchars($_POST['cena']);
    $kat_id = htmlspecialchars($_POST['id_kategorija']);

    $bildes = $_FILES['bildes'];
    $bildePaths = [];

    if ($bildes && count($bildes['name']) > 0) {
        for ($i = 0; $i < min(3, count($bildes['name'])); $i++) {
            $imageData = file_get_contents($bildes['tmp_name'][$i]);
            $bildePaths[] = $imageData;
        }
    }

    while (count($bildePaths) < 3) {
        $bildePaths[] = null;
    }

    if (!empty($nosaukums) && !empty($materials) && !empty($apraksts) && !empty($cena) && !empty($kat_id)) {
        $vaicajums = $savienojums->prepare(
            "INSERT INTO Waflas_preces (Nosaukums, Materials, Apraksts, Cena, Kategorija, Bilde1, Bilde2, Bilde3)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $vaicajums->bind_param(
            "sssdibbb",
            $nosaukums,
            $materials,
            $apraksts,
            $cena,
            $kat_id,
            $null,
            $null,
            $null
        );

        $vaicajums->send_long_data(5, $bildePaths[0]);
        $vaicajums->send_long_data(6, $bildePaths[1]);
        $vaicajums->send_long_data(7, $bildePaths[2]);

        if ($vaicajums->execute()) {
            echo "Produkts veiksmīgi izveidots!";
        } else {
            echo "Kļūda sistēmā: " . $vaicajums->error;
        }

        $vaicajums->close();
        $savienojums->close();
    } else {
        echo "Visi ievades lauki nav aizpildīti!";
    }
} else {
    echo "Nepilnīgi dati!";
}
?>