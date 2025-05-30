<?php
require __DIR__ . '/../../assets/con_db.php';

if (!isset($page)) {
    $page = '';
}

$izvadeSQL = " SELECT a.*, l.Vards, l.Uzvards, l.Bilde FROM waflas_atsauksmes AS a JOIN waflas_lietotaji AS l ON a.id_lietotajs = l.Lietotajs_ID ORDER BY a.Piev_datums DESC ";
$atlasaAtsauksmesSQL = mysqli_query($savienojums, $izvadeSQL);

if (mysqli_num_rows($atlasaAtsauksmesSQL) > 0) {
    while ($atsauksme = mysqli_fetch_assoc($atlasaAtsauksmesSQL)) {
        if (!empty($atsauksme['Bilde'])) {
            $imageData = base64_encode($atsauksme['Bilde']);
            $imageSrc = "data:image/jpeg;base64,{$imageData}";
        } else {
            $imageSrc = '/images/profile.png';
        }

        $zvaigznes = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $atsauksme['Zvaigznes_sk']) {
                if ($page === 'atsauksmes') {
                    $zvaigznes .= '<i class="fa-solid fa-star" style="color: var(--maincolor);"></i>';
                } elseif ($page === 'galvena') {
                    $zvaigznes .= '<i class="fa-solid fa-star" style="color: #fdfd77;"></i>';
                }
            } else {
                $zvaigznes .= '<i class="fa-regular fa-star"></i>';
            }
        }

        if ($page === 'atsauksmes') {
            echo "
        <div class='box animate'>
            <div class='atsauksme'>
                <div class='mini-box'>
                    <img src='{$imageSrc}'>
                    <p>{$atsauksme['Vards']} {$atsauksme['Uzvards']}<br> 
                    <em><span>{$atsauksme['Piev_datums']}</span></em><br></p>
                </div>
                <p>{$zvaigznes}</p>
            </div>
            <p>{$atsauksme['Teksts']}</p>
        </div>
        ";
        } elseif ($page === 'galvena') {
            echo " <div class='atsauksme'>
                <img src='{$imageSrc}'>
                 <p>{$zvaigznes}</p>
                <p><q>{$atsauksme['Teksts']}</q></p>
                <div class='divider'></div>
                <h3>{$atsauksme['Vards']} {$atsauksme['Uzvards']}</h3>
                <p id='country'><em>Latvija</em></p>
            </div>";
        }
    }
} else {
    echo "Nav nevienas atsauksmes";
}

?>