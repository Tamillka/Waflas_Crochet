<?php
// Ielādē datubāzes savienojuma failu un sāk sesiju
require '../../assets/con_db.php';
session_start();

// Norāda, ka atbildes saturs būs JSON formātā
header('Content-Type: application/json');

// Iegūst pašreizējā lietotāja ID no sesijas
$lietotajs_id = $_SESSION['lietotajs_id'];

// SQL vaicājums, lai iegūtu grozā esošās preces kopā ar to informāciju
$vaicajums = "
    SELECT p.Nosaukums, p.Cena, p.Bilde1, p.Materials, g.Grozs_ID, g.Daudzums
    FROM waflas_grozs g
    JOIN waflas_preces p ON g.id_prece = p.Preces_ID
    WHERE g.id_lietotajs = ?
";

// Sagatavo un izpilda vaicājumu ar piesaistītu lietotāja ID
$stmt = $savienojums->prepare($vaicajums);
$stmt->bind_param("i", $lietotajs_id);
$stmt->execute();

// Iegūst rezultātu kopu no izpildītā vaicājuma
$rezultats = $stmt->get_result();

$preces = [];

// Izveido finfo objektu, lai noteiktu attēla MIME tipu
$finfo = new finfo(FILEINFO_MIME_TYPE);

// Cikls cauri visām atrastajām precēm
while ($ieraksts = $rezultats->fetch_assoc()) {
    $mime_type = $finfo->buffer($ieraksts['Bilde1']); // Noteic attēla tipu

    // Izveido masīvu ar preces datiem
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

// Atgriež visus sagatavotos preču datus JSON formātā
echo json_encode($preces);
?>