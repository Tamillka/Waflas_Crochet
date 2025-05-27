<?php
require __DIR__ . '/../../assets/con_db.php';

$datumi = [];
for ($i = 5; $i >= 0; $i--) {
    $datumi[] = date("Y-m-d", strtotime("-$i days"));
}

$sql = "SELECT DATE(Pasut_datums) as datums, COUNT(*) as pasutijumu_skaits
        FROM Waflas_pasutijumi
        WHERE Pasut_datums >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
        GROUP BY datums
        ORDER BY datums";
$result = $savienojums->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[$row['datums']] = $row['pasutijumu_skaits'];
}


$finalData = [];
foreach ($datumi as $datums) {
    $finalData[] = [
        'datums' => $datums,
        'pasutijumu_skaits' => $data[$datums] ?? 0
    ];
}


echo "<script>
    const chartData = " . json_encode($finalData) . ";
</script>";
?>