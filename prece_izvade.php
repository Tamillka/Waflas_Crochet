<?php
require "assets/con_db.php";

// Izvēlamies, cik produktus parādīt atkarībā no lapas
if ($page === 'galvena') {
    $izvadeSQL = "SELECT * FROM Waflas_preces ORDER BY Piev_datums DESC LIMIT 4";
} else if ($page === 'produkcija') {
    $izvadeSQL = "SELECT * FROM Waflas_preces ORDER BY Piev_datums DESC";
}

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

       
    }
} else {
    echo "Nav nevienu piedāvājumu";
}
?>