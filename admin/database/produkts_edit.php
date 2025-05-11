<?php
require '../../assets/con_db.php';

if (isset($_POST['id'])) {
    $p_nosaukums = htmlspecialchars($_POST['nosaukums']);
    $p_materials = htmlspecialchars($_POST['materials']);
    $p_apraksts = htmlspecialchars($_POST['apraksts']);
    $p_cena = htmlspecialchars($_POST['cena']);
    $p_kat_id = htmlspecialchars($_POST['id_kategorija']);
    $id = intval($_POST['id']);
    $bildes = $_FILES['bildes'];
    $bildeData = [null, null, null];

    for ($i = 0; $i < min(3, count($bildes['name'])); $i++) {
        if (!empty($bildes['tmp_name'][$i])) {
            $bildeData[$i] = file_get_contents($bildes['tmp_name'][$i]);
        }
    }

    $fields = "Nosaukums = ?, Materials = ?, Apraksts = ?, Cena = ?, Kategorija = ?, Izm_datums = NOW()";
    $params = [$p_nosaukums, $p_materials, $p_apraksts, floatval($p_cena), intval($p_kat_id)];
    $types = "sssd" . "i";

    if ($bildeData[0] !== null) {
        $fields .= ", Bilde1 = ?";
        $params[] = $bildeData[0];
        $types .= "b";
    }
    if ($bildeData[1] !== null) {
        $fields .= ", Bilde2 = ?";
        $params[] = $bildeData[1];
        $types .= "b";
    }
    if ($bildeData[2] !== null) {
        $fields .= ", Bilde3 = ?";
        $params[] = $bildeData[2];
        $types .= "b";
    }

    $params[] = $id;
    $types .= "i";

    $sql = "UPDATE Waflas_preces SET $fields WHERE Preces_ID = ?";
    $stmt = $savienojums->prepare($sql);

    $stmt->bind_param($types, ...$params);

    $index = 0;
    foreach ($params as $i => $val) {
        if (is_string($val) && $types[$i] === 'b') {
            $stmt->send_long_data($index, $val);
        }
        $index++;
    }

    $stmt->execute();
    $stmt->close();
    $savienojums->close();
}
?>