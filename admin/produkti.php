<?php
$page = "produkti";
require "header.php";
?>

<p class="svariga-info">Administrācijas sadaļa satur īpaši svarīgus datus, kas būtiski ietekmē sistēmas darbību un
    drošību. <br>
    Saglabājiet datus rūpīgi un izvairieties no nevajadzīgām izmaiņām vai dzēšanas. </p>

<div class="admin-main">
    <table>
        <tr>
            <th>ID</th>
            <th>Nosaukums</th>
            <th>Bilde</th>
            <th>Cena</th>
            <th>Materials</th>
            <th>Datums</th>
            <th></th>

        </tr>
        <tbody id="produkti"></tbody>
    </table>
</div>

<div class="admin-main kategorijas">
    <table id="kategorijasTab">
        <tr>
            <th>ID</th>
            <th>Nosaukums</th>
            <th>Bilde</th>
            <th>Datums</th>
            <th></th>

        </tr>
        <tbody id="kategorijas"></tbody>
    </table>
    <div class="produkta-info">
        <p>Šajā sadaļā pieejamas apskatīšanai un rediģēšanai visas produktu kategorijas</p>
        <button class="btn pievienot"><i class="fas fa-plus"></i> Pievienot jaunu</button>
    </div>

</div>