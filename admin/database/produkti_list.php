<?php
require '../../assets/con_db.php';

$vaicajums = "SELECT * FROM Waflas_preces WHERE Radits=1 ORDER BY Preces_ID DESC";
$rezultats = mysqli_query($savienojums, $vaicajums);

while ($ieraksts = $rezultats->fetch_assoc()) {

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->buffer($ieraksts['Bilde1']);

    $json[] = array(
        'id' => htmlspecialchars($ieraksts['Preces_ID']),
        'nosaukums' => htmlspecialchars($ieraksts['Nosaukums']),
        'cena' => htmlspecialchars($ieraksts['Cena']),
        'materials' => htmlspecialchars($ieraksts['Materials']),
        'bilde' => 'data:' . $mime_type . ';base64,' . base64_encode($ieraksts['Bilde1']),
        'datums' => date("d.m.Y. H:i", strtotime($ieraksts['Piev_datums'])),
    );
}

$jsonstring = json_encode($json);
echo $jsonstring;
?>