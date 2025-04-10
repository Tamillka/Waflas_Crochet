<?php
require "assets/con_db.php";

$izvadeSQL = "SELECT * FROM Waflas_preces ORDER BY Piev_datums DESC LIMIT 4";
$atlasaPrecesSQL = mysqli_query($savienojums, $izvadeSQL);

if (mysqli_num_rows($atlasaPrecesSQL) > 0) {
    while ($prece = mysqli_fetch_assoc($atlasaPrecesSQL)) {
        // Base64 kodēšana no BLOB datiem
        $imageData1 = base64_encode($prece['Bilde1']);
        $imageSrc1 = "data:image/jpeg;base64,{$imageData1}";

        $imageData2 = base64_encode($prece['Bilde2']);
        $imageSrc2 = "data:image/jpeg;base64,{$imageData2}";

        $imageData3 = base64_encode($prece['Bilde3']);
        $imageSrc3 = "data:image/jpeg;base64,{$imageData3}";

        // Dinamiski ģenerē modālā loga ID
        $modalID = "modalTicket" . $prece['Preces_ID'];

        echo "
        
        <div class='box animate'>
            <img src='{$imageSrc1}'>
            <button class='btn active' data-target='#{$modalID}'>Atvērt</button>
            <h3>{$prece['Nosaukums']}</h3>
            <p>{$prece['Materials']}</p>
            <h3>{$prece['Cena']}€</h3>
        </div>
        ";
    }
} else {
    echo "Nav nevienu piedāvājumu";
}

// } else if ($page === 'produkcija') {
//     $vaicajums = "SELECT * FROM Waflas_preces ORDER BY Piev_datums DESC";
//     $rezultats = mysqli_query($savienojums, $vaicajums);

//     while($ieraksts = $rezultats->fetch_assoc()){
//         $json[] = array(
//             'id' => htmlspecialchars($ieraksts['Preces_ID']),
//             'nosaukums' => htmlspecialchars($ieraksts['Nosaukums']),
//             'apraksts' => htmlspecialchars($ieraksts['Apraksts']),
//             'cena' => htmlspecialchars($ieraksts['Cena']),
//             'materials' => htmlspecialchars($ieraksts['Materials']),
//             'bilde1' => 'data:image/jpeg;base64,' . base64_encode($ieraksts['Bilde1']),
//             'bilde2' => 'data:image/jpeg;base64,' . base64_encode($ieraksts['Bilde2']),
//             'bilde3' => 'data:image/jpeg;base64,' . base64_encode($ieraksts['Bilde3']),
//             'datums' => date("d.m.Y. H:i", strtotime($ieraksts['Piev_datums'])),
//         );
//     }
//     $jsonstring = json_encode($json);
//     echo $jsonstring;
// }


?>