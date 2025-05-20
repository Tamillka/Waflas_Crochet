<?php
require '../../assets/con_db.php';

if (isset($_POST['id'])) {
    $id = htmlspecialchars($_POST['id']);

    $vaicajums = $savienojums->prepare("
        SELECT 
            p.Pasutijums_ID,
            p.Vards,
            p.Uzvards,
            p.Epasts,
            p.Summa,
            p.Statuss,
            p.Pasut_datums,
            p.Izm_datums,
            pr.Nosaukums AS preces_nosaukums,
            ps.Vienibas_sk,
            ps.Vienibu_kopeja_cena
        FROM waflas_pasutijumi p
        LEFT JOIN pasutijuma_sastavdalas ps ON p.Pasutijums_ID = ps.id_pasutijums
        LEFT JOIN waflas_preces pr ON ps.id_prece = pr.Preces_ID
        WHERE p.Pasutijums_ID = ?
    ");

    $vaicajums->bind_param("i", $id);
    $vaicajums->execute();
    $rezultats = $vaicajums->get_result();

    if (!$rezultats) {
        die('Kļūda! ' . $savienojums->error);
    }

    $pasutijums = [];
    $pasutijums['produkti'] = [];

    while ($ieraksts = $rezultats->fetch_assoc()) {
        // Общая информация (однократно)
        if (empty($pasutijums['id'])) {
            $pasutijums['id'] = htmlspecialchars($ieraksts['Pasutijums_ID']);
            $pasutijums['vards'] = htmlspecialchars($ieraksts['Vards']);
            $pasutijums['uzvards'] = htmlspecialchars($ieraksts['Uzvards']);
            $pasutijums['epasts'] = htmlspecialchars($ieraksts['Epasts']);
            $pasutijums['summa'] = htmlspecialchars($ieraksts['Summa']);
            $pasutijums['statuss'] = htmlspecialchars($ieraksts['Statuss']);
            $pasutijums['datums'] = date("d.m.Y. H:i", strtotime($ieraksts['Pasut_datums']));
            $pasutijums['redigesanas_datums'] = date("d.m.Y. H:i", strtotime($ieraksts['Izm_datums']));
        }

        $pasutijums['produkti'][] = array(
            'nosaukums' => htmlspecialchars($ieraksts['preces_nosaukums']),
            'vienibas_sk' => (int) $ieraksts['Vienibas_sk'],
            'kopeja_cena' => htmlspecialchars($ieraksts['Vienibu_kopeja_cena'])
        );
    }

    $vaicajums->close();
    $savienojums->close();

    echo json_encode($pasutijums);
}
?>