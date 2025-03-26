<?php
require "assets/con_db.php";

// Izvēlamies, cik produktus parādīt atkarībā no lapas
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

        <!-- Popup for product -->
             <div id='{$modalID}' class='popup'>
                 <div class='popup-content'>
                     <span class='closeBtn' data-target='#{$modalID}'>&times;</span>
                     <div class='image-gallery'>
                         <img id='mainImage{$prece['Preces_ID']}' src='{$imageSrc1}' class='large-image'>
                         <div class='thumbnails'>
                             <img src='{$imageSrc1}' class='thumbnail active' data-large='{$imageSrc1}' data-main='mainImage{$prece['Preces_ID']}'>
                             <img src='{$imageSrc2}' class='thumbnail' data-large='{$imageSrc2}' data-main='mainImage{$prece['Preces_ID']}'>
                             <img src='{$imageSrc3}' class='thumbnail' data-large='{$imageSrc3}' data-main='mainImage{$prece['Preces_ID']}'>
                         </div>
                     </div>
                     <h3>{$prece['Nosaukums']}</h3>
                     <p>{$prece['Apraksts']}</p>
                     <h3>{$prece['Cena']}€</h3>
                    <button class='btn pievienotGrozam'>Pievienot grozam</button>
                 </div>
           </div>
     
            
             ";


    }
} else {
    echo "Nav nevienu piedāvājumu";
}
?>