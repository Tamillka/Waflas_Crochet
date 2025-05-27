<?php
# 1.statistika
$pasutijumi_SQL = "SELECT COUNT(Pasutijums_ID) from Waflas_pasutijumi";
$atlasa_pasutijumi = mysqli_query($savienojums, $pasutijumi_SQL);

while ($ieraksts = mysqli_fetch_array($atlasa_pasutijumi)) {
    $pasutijumi = "{$ieraksts['COUNT(Pasutijums_ID)']}";
}

# 2.statistika
$produkti_SQL = "SELECT COUNT(Preces_ID) from Waflas_preces";
$atlasa_produkti = mysqli_query($savienojums, $produkti_SQL);

while ($ieraksts = mysqli_fetch_array($atlasa_produkti)) {
    $produkti = "{$ieraksts['COUNT(Preces_ID)']}";
}

# 3.statistika
$atsauksmes_SQL = "SELECT COUNT(Atsauksmes_ID) from Waflas_atsauksmes";
$atlasa_atsauksmes = mysqli_query($savienojums, $atsauksmes_SQL);

while ($ieraksts = mysqli_fetch_array($atlasa_atsauksmes)) {
    $atsauksmes = "{$ieraksts['COUNT(Atsauksmes_ID)']}";
}

# 4.statistika
$lietotaji_SQL = "SELECT COUNT(Lietotajs_ID) from Waflas_lietotaji";
$atlasa_lietotaji = mysqli_query($savienojums, $lietotaji_SQL);

while ($ieraksts = mysqli_fetch_array($atlasa_lietotaji)) {
    $lietotaji = "{$ieraksts['COUNT(Lietotajs_ID)']}";
}

# 5.statistika
function get_ienemumi($savienojums, $period)
{
    $sql = "SELECT SUM(Summa) AS ienemums FROM Waflas_pasutijumi WHERE Pasut_datums >= ?";
    $stmt = $savienojums->prepare($sql);

    $date_limit = match ($period) {
        'day' => date('Y-m-d H:i:s', strtotime('-1 day')),
        'week' => date('Y-m-d H:i:s', strtotime('-7 days')),
        'month' => date('Y-m-d H:i:s', strtotime('-1 month')),
        'year' => date('Y-m-d H:i:s', strtotime('-1 year')),
        default => date('Y-m-d H:i:s'),
    };

    $stmt->bind_param("s", $date_limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return number_format($row['ienemums'] ?? 0, 2);
}

$ienemums_diena = get_ienemumi($savienojums, 'day');
$ienemums_nedela = get_ienemumi($savienojums, 'week');
$ienemums_menesis = get_ienemumi($savienojums, 'month');
$ienemums_gads = get_ienemumi($savienojums, 'year');

# 6.statistika
$klienti_SQL = "SELECT COUNT(Lietotajs_ID) from Waflas_lietotaji WHERE Loma = 'Klients'";
$atlasa_klienti = mysqli_query($savienojums, $klienti_SQL);

while ($ieraksts = mysqli_fetch_array($atlasa_klienti)) {
    $klienti = "{$ieraksts['COUNT(Lietotajs_ID)']}";
}

# 6.statistika
$moderi_SQL = "SELECT COUNT(Lietotajs_ID) from Waflas_lietotaji WHERE Loma = 'Moderators'";
$atlasa_moderi = mysqli_query($savienojums, $moderi_SQL);

while ($ieraksts = mysqli_fetch_array($atlasa_moderi)) {
    $moderatori = "{$ieraksts['COUNT(Lietotajs_ID)']}";
}

# 6.statistika
$admini_SQL = "SELECT COUNT(Lietotajs_ID) from Waflas_lietotaji WHERE Loma = 'Administrators'";
$atlasa_admini = mysqli_query($savienojums, $admini_SQL);

while ($ieraksts = mysqli_fetch_array($atlasa_admini)) {
    $administratori = "{$ieraksts['COUNT(Lietotajs_ID)']}";
}
?>