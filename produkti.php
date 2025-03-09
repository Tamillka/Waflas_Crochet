<?php
require "assets/con_db.php";

// Pārbauda, vai ir nodots kategorijas ID
$kategorija_id = isset($_GET['kategorija_id']) ? intval($_GET['kategorija_id']) : 0;

if ($kategorija_id > 0) {
    $vaicajums = "SELECT * FROM Waflas_preces WHERE Kategorija = $kategorija_id ORDER BY Piev_datums DESC";
} else {
    $vaicajums = "SELECT * FROM Waflas_preces ORDER BY Piev_datums DESC";
}

$rezultats = mysqli_query($savienojums, $vaicajums);

$json = []; // Iniciē json masīvu

while($ieraksts = $rezultats->fetch_assoc()){
    $json[] = array(
        'id' => htmlspecialchars($ieraksts['Preces_ID']),
        'nosaukums' => htmlspecialchars($ieraksts['Nosaukums']),
        'apraksts' => htmlspecialchars($ieraksts['Apraksts']),
        'cena' => htmlspecialchars($ieraksts['Cena']),
        'materials' => htmlspecialchars($ieraksts['Materials']),
        'bilde1' => 'data:image/jpeg;base64,' . base64_encode($ieraksts['Bilde1']),
        'bilde2' => 'data:image/jpeg;base64,' . base64_encode($ieraksts['Bilde2']),
        'bilde3' => 'data:image/jpeg;base64,' . base64_encode($ieraksts['Bilde3']),
        'datums' => date("d.m.Y. H:i", strtotime($ieraksts['Piev_datums'])),
    );
}

echo json_encode($json);
?>