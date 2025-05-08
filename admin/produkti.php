<?php
$page = "produkti";
require "header.php";
?>
<script src="../assets/kategorijas_admin.js" defer></script>
<script src="../assets/produkti_admin.js" defer></script>

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
        <button class="btn pievienot" id="new-btn"><i class="fas fa-plus"></i> Pievienot jaunu</button>
    </div>

</div>

<div class="modal" id="modal-admin">
    <div class="modal-box">
        <div class="close-modal">
            <i class="fas fa-times"></i>
        </div>
        <h2>Produkta kategorija</h2>
        <form id="kategorijasForma" enctype="multipart/form-data">
            <div class="formElements">
                <label>Nosaukums *</label>
                <input type="text" id="nosaukums" name="nosaukums" required>
                <label>Bilde *</label>
                <input type="file" id="bilde" name="bilde" accept="image/*">
                <img id="preview-image" style="max-width: 200px; display: none;">
                <input type="hidden" id="kat_ID" name="id">
            </div>
            <button type="submit" name="nosutit" id="nosutit" class="btn active">Saglabāt</button>
        </form>
        <div id="kategorijas-informacija"></div>

    </div>
</div>

<div id="notifikacija" class="notifikacija hidden">
    <div class="closeNotif">
        <i class="fas fa-times"></i>
    </div>
    <span id="notifikacijas-teksts"></span>
</div>