<?php
require_once 'omniva_config.php';

$request = new Request();
$locations = $request->getLocations('LV'); // 'LV' для Латвии

echo '<select name="omniva_terminal" required>';
echo '<option value="">-- Izvēlies pakomātu --</option>';

foreach ($locations as $terminal) {
    $code = htmlspecialchars($terminal->ZIP);
    $name = htmlspecialchars($terminal->NAME);
    echo "<option value=\"$code\">$name</option>";
}

echo '</select>';
?>