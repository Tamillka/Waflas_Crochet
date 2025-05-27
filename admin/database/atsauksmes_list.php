<?php
require '../../assets/con_db.php';

$sql = "
    SELECT 
        a.Atsauksmes_ID,
        a.Zvaigznes_sk,
        a.Teksts,
        a.Piev_datums,
        l.Epasts,
        l.Lietotajvards,
        l.Bilde
    FROM waflas_atsauksmes AS a
    JOIN waflas_lietotaji AS l ON a.id_lietotajs = l.Lietotajs_ID
    ORDER BY a.Atsauksmes_ID DESC
";

$rezultats = mysqli_query($savienojums, $sql);
$json = [];

while ($ieraksts = $rezultats->fetch_assoc()) {

    $bilde_encoded = '';
    if (!empty($ieraksts['Bilde'])) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime_type = $finfo->buffer($ieraksts['Bilde']);
        $bilde_encoded = 'data:' . $mime_type . ';base64,' . base64_encode($ieraksts['Bilde']);
    } else {
        $bilde_encoded = '/images/profile.png';
    }

    $json[] = [
        'id' => (int) $ieraksts['Atsauksmes_ID'],
        'lietotajvards' => htmlspecialchars($ieraksts['Lietotajvards']),
        'epasts' => htmlspecialchars($ieraksts['Epasts']),
        'bilde' => $bilde_encoded,
        'vertejums' => (int) $ieraksts['Zvaigznes_sk'],
        'teksts' => htmlspecialchars($ieraksts['Teksts']),
        'datums' => date("d.m.Y. H:i", strtotime($ieraksts['Piev_datums'])),
    ];
}

$jsonstring = json_encode($json);
echo $jsonstring;
?>