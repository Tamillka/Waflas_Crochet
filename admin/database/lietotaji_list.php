<?php
require '../../assets/con_db.php';

$vaicajums = "SELECT * FROM Waflas_lietotaji WHERE Radits = 1 AND Loma = 'Administrators' OR Loma = 'Moderators' ORDER BY lietotajs_id DESC";
$rezultats = mysqli_query($savienojums, $vaicajums);

while ($ieraksts = $rezultats->fetch_assoc()) {
    $json[] = array(
        'id' => htmlspecialchars($ieraksts['Lietotajs_ID']),
        'lietotajvards' => htmlspecialchars($ieraksts['Lietotajvards']),
        'vards' => htmlspecialchars($ieraksts['Vards']),
        'uzvards' => htmlspecialchars($ieraksts['Uzvards']),
        'epasts' => htmlspecialchars($ieraksts['Epasts']),
        'talrunis' => htmlspecialchars($ieraksts['Talrunis']),
        'loma' => htmlspecialchars($ieraksts['Loma']),
        // 'datums' => date("d.m.Y. H:i", strtotime($ieraksts['datums'])),
    );
}

$jsonstring = json_encode($json);
echo $jsonstring;
?>