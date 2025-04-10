<?php
require '../../assets/con_db.php';

$vaicajums = "SELECT * FROM Waflas_kategorija WHERE Radits=1 ORDER BY Kategorijas_ID DESC";
$rezultats = mysqli_query($savienojums, $vaicajums);

while ($ieraksts = $rezultats->fetch_assoc()) {

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->buffer($ieraksts['Bilde']);

    $json[] = array(
        'id' => htmlspecialchars($ieraksts['Kategorijas_ID']),
        'nosaukums' => htmlspecialchars($ieraksts['Nosaukums']),
        'bilde' => 'data:' . $mime_type . ';base64,' . base64_encode($ieraksts['Bilde']),
        'datums' => date("d.m.Y. H:i", strtotime($ieraksts['Piev_datums'])),
    );
}

$jsonstring = json_encode($json);
echo $jsonstring;
?>