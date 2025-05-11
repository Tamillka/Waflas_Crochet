<?php
require '../../assets/con_db.php';

if (isset($_POST['id'])) {
    $id = htmlspecialchars($_POST['id']);

    $vaicajums = $savienojums->prepare("
    SELECT 
        p.Preces_ID,
        p.Nosaukums AS PrecesNosaukums,
        p.Materials,
        p.Apraksts,
        p.Cena,
        p.Piev_datums,
        p.Izm_datums,
        p.Kategorija,
        p.Bilde1, p.Bilde2, p.Bilde3,
        k.Nosaukums AS KategorijasNosaukums
    FROM Waflas_preces AS p
    LEFT JOIN Waflas_kategorija AS k
    ON p.Kategorija = k.Kategorijas_ID
    WHERE p.Preces_ID = ?
");
    $vaicajums->bind_param("i", $id);

    if ($vaicajums->execute()) {
        $rezultats = $vaicajums->get_result();

        if ($rezultats->num_rows > 0) {
            $ieraksts = $rezultats->fetch_assoc();

            // Datu formatēšana un izvade JSON formātā
            $json = [
                'id' => htmlspecialchars($ieraksts['Preces_ID']),
                'nosaukums' => htmlspecialchars($ieraksts['PrecesNosaukums']),
                'materials' => htmlspecialchars($ieraksts['Materials']),
                'cena' => htmlspecialchars($ieraksts['Cena']),
                'apraksts' => htmlspecialchars($ieraksts['Apraksts']),
                'datums' => date("d.m.Y. H:i", strtotime($ieraksts['Piev_datums'])),
                'redigesanas_datums' => date("d.m.Y. H:i", strtotime($ieraksts['Izm_datums'])),
                'id_kategorija' => htmlspecialchars($ieraksts['Kategorija']),
                'kategorijas_nosaukums' => htmlspecialchars($ieraksts['KategorijasNosaukums']),
                'bilde1' => base64_encode($ieraksts['Bilde1']),
                'bilde2' => base64_encode($ieraksts['Bilde2']),
                'bilde3' => base64_encode($ieraksts['Bilde3']),
            ];

            echo json_encode($json);
        } else {
            echo json_encode(['error' => 'Nav atrasts ieraksts ar šo ID!']);
        }
    } else {
        echo json_encode(['error' => 'Nevarēja izpildīt vaicājumu: ' . $savienojums->error]);
    }

    $vaicajums->close();
    $savienojums->close();
} else {
    echo json_encode(['error' => 'ID netika nosūtīts!']);
}