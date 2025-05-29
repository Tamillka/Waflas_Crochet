<?php
require_once __DIR__ . '/../../vendor/omniva-api-lib-master/src/OmnivaException.php';

$city = $_GET['city'] ?? '';
$city = trim($city);

if (!$city) {
    echo '<option value="">Nav pilsētas</option>';
    exit;
}

try {
    $all = json_decode(file_get_contents('https://www.omniva.ee/locations.json'), true);
    $cityLower = mb_strtolower($city);

    $filtered = array_filter($all, function ($loc) use ($cityLower) {
        return strtolower($loc['A0_NAME']) === 'lv' &&
            str_contains(mb_strtolower($loc['A1_NAME']), $cityLower);
    });

    if (empty($filtered)) {
        echo '<option value="">Nav atrasti pakomāti</option>';
        exit;
    }

    echo '<option value="">-- Izvēlies pakomātu --</option>';
    foreach ($filtered as $terminal) {
        $zip = htmlspecialchars($terminal['ZIP']);
        $name = htmlspecialchars($terminal['NAME']);
        echo "<option value=\"$zip\">$name</option>";
    }
} catch (Exception $e) {
    echo '<option value="">Kļūda pakomātu ielādē</option>';
}