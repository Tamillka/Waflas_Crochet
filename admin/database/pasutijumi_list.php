<?php
require '../../assets/con_db.php';

$vaicajums = "
    SELECT p.Pasutijums_ID, p.Vards, p.Uzvards, p.Epasts, p.Summa, p.Statuss, p.Pasut_datums,
    SUM(s.Vienibas_sk) AS preces_skaits
    FROM waflas_pasutijumi p
    LEFT JOIN pasutijuma_sastavdalas s ON p.Pasutijums_ID = s.id_pasutijums
    GROUP BY p.Pasutijums_ID
    ORDER BY p.Pasutijums_ID DESC
";

$rezultats = mysqli_query($savienojums, $vaicajums);

$json = [];
while ($ieraksts = $rezultats->fetch_assoc()) {
    $json[] = array(
        'id' => htmlspecialchars($ieraksts['Pasutijums_ID']),
        'vards' => htmlspecialchars($ieraksts['Vards']),
        'uzvards' => htmlspecialchars($ieraksts['Uzvards']),
        'epasts' => htmlspecialchars($ieraksts['Epasts']),
        'summa' => htmlspecialchars($ieraksts['Summa']),
        'statuss' => htmlspecialchars($ieraksts['Statuss']),
        'preces_skaits' => (int) $ieraksts['preces_skaits'],
        'datums' => date("d.m.Y. H:i", strtotime($ieraksts['Pasut_datums'])),
    );
}

$jsonstring = json_encode($json);
echo $jsonstring;
?>