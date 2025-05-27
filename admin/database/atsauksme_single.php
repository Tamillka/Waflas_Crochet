<?php
require '../../assets/con_db.php';
if (isset($_POST['id'])) {
    $id = htmlspecialchars($_POST['id']);
    $vaicajums = $savienojums->prepare(" SELECT 
        a.Atsauksmes_ID,
        a.Zvaigznes_sk,
        a.Teksts,
        a.Piev_datums,
        l.Epasts,
        l.Vards,
        l.Uzvards
    FROM waflas_atsauksmes AS a
    JOIN waflas_lietotaji AS l ON a.id_lietotajs = l.Lietotajs_ID
    WHERE Atsauksmes_ID = ?");

    $vaicajums->bind_param("i", $id);
    $vaicajums->execute();
    $rezultats = $vaicajums->get_result();
    if (!$rezultats) {
        die('Kļūda! ' . $savienojums->error);
    }

    while ($ieraksts = $rezultats->fetch_assoc()) {
        $json[] = array(
            'id' => htmlspecialchars($ieraksts['Atsauksmes_ID']),
            'vards' => htmlspecialchars($ieraksts['Vards']),
            'uzvards' => htmlspecialchars($ieraksts['Uzvards']),
            'epasts' => htmlspecialchars($ieraksts['Epasts']),
            'teksts' => htmlspecialchars($ieraksts['Teksts']),
            'vertejums' => htmlspecialchars($ieraksts['Zvaigznes_sk']),
            'datums' => date("d.m.Y. H:i", strtotime($ieraksts['Piev_datums'])),
        );
    }

    $vaicajums->close();
    $savienojums->close();

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
?>