<?php
require '../../assets/con_db.php';
session_start();

header('Content-Type: application/json');

$lietotajs_id = $_SESSION['lietotajs_id'];
$vaicajums = "
    SELECT 
        p.Nosaukums, 
        p.Cena, 
        p.Bilde1,
        p.Materials,
        g.Grozs_ID,
        g.Daudzums
    FROM waflas_grozs g
    JOIN waflas_preces p ON g.id_prece = p.Preces_ID
    WHERE g.id_lietotajs = ?
";

$stmt = $savienojums->prepare($vaicajums);
$stmt->bind_param("i", $lietotajs_id);
$stmt->execute();

$rezultats = $stmt->get_result();

$preces = [];

$finfo = new finfo(FILEINFO_MIME_TYPE);

while ($ieraksts = $rezultats->fetch_assoc()) {
    $mime_type = $finfo->buffer($ieraksts['Bilde1']);

    $preces[] = array(
        'nosaukums' => $ieraksts['Nosaukums'],
        'cena' => $ieraksts['Cena'],
        'materials' => $ieraksts['Materials'],
        'daudzums' => $ieraksts['Daudzums'],
        'kopCena' => $ieraksts['Daudzums'] * $ieraksts['Cena'],
        'bilde1' => 'data:' . $mime_type . ';base64,' . base64_encode($ieraksts['Bilde1']),
        'grozs_id' => $ieraksts['Grozs_ID']
    );
}

echo json_encode($preces);
?>