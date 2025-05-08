<?php
require "assets/con_db.php";

$kategorija = isset($_GET['kategorija']) ? mysqli_real_escape_string($savienojums, $_GET['kategorija']) : "";
$kategorija_id = isset($_GET['kategorija_id']) ? intval($_GET['kategorija_id']) : 0;
$kartosana = isset($_GET['kartosana']) ? $_GET['kartosana'] : '';
$materiali = isset($_GET['materiali']) ? explode(",", $_GET['materiali']) : [];

if (empty($kategorija) && $kategorija_id > 0) {
    $kategorija = $kategorija_id;
}

$sortSql = " ORDER BY Piev_datums DESC";

switch ($kartosana) {
    case 'cenaaug':
        $sortSql = " ORDER BY Cena ASC";
        break;
    case 'cenadilst':
        $sortSql = " ORDER BY Cena DESC";
        break;
    case 'alfabetaug':
        $sortSql = " ORDER BY Nosaukums ASC";
        break;
    case 'alfabetdilst':
        $sortSql = " ORDER BY Nosaukums DESC";
        break;
    case 'pievdat':
        $sortSql = " ORDER BY Piev_datums DESC";
        break;
    case 'pievdataug':
        $sortSql = " ORDER BY Piev_datums ASC";
        break;
}

$whereClauses = [];

if (!empty($kategorija)) {
    $whereClauses[] = "Kategorija = '$kategorija'";
}

if (!empty($materiali)) {
    $escapedMateriali = array_map(function ($mat) use ($savienojums) {
        return "Materials LIKE '%" . mysqli_real_escape_string($savienojums, $mat) . "%'";
    }, $materiali);
    $whereClauses[] = "(" . implode(" OR ", $escapedMateriali) . ")";
}

$whereClauses[] = "Radits = 1";
$whereSql = " WHERE " . implode(" AND ", $whereClauses);

$vaicajums = "SELECT * FROM Waflas_preces $whereSql $sortSql";

$rezultats = mysqli_query($savienojums, $vaicajums);
$json = [];

while ($ieraksts = $rezultats->fetch_assoc()) {
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