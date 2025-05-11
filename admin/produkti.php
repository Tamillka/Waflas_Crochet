<?php
$page = "produkti";
require "header.php";
?>
<script src="../assets/kategorijas_admin.js" defer></script>
<script src="../assets/produkti_admin.js" defer></script>

<p class="svariga-info">Administrācijas sadaļa satur īpaši svarīgus datus, kas būtiski ietekmē sistēmas darbību un
    drošību. <br>
    Saglabājiet datus rūpīgi un izvairieties no nevajadzīgām izmaiņām vai dzēšanas. </p>
>
<div class="admin-main">
    <div class="top">
        <button class="btn pievienot" id="new-btn-prod"><i class="fas fa-plus"></i> Pievienot jaunu</button>
    </div>
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

<div class="modal" id="modal-produkti">
    <div class="modal-box">
        <div class="close-modal">
            <i class="fas fa-times"></i>
        </div>
        <h3>Produkcija</h3>
        <div class="box">
            <form id="produktaForma" enctype="multipart/form-data">
                <div class="formElements">
                    <label>Nosaukums *</label>
                    <input type="text" id="nosaukums" name="nosaukums" required>
                    <label>Materials *</label>
                    <select id="materials" name="materials" required>
                        <option value="Plīša dzija">Plīša dzija</option>
                        <option value="Kokvilna">Kokvilna</option>
                        <option value="Džutas dzija">Džutas dzija</option>
                        <option value="Viskoze">Viskoze</option>
                    </select>
                    <label>Apraksts *</label>
                    <textarea placeholder="Produkta apraksts..." id="apraksts" name="apraksts"></textarea>
                    <label>Cena *</label>
                    <input typa="number" name="cena" id="cena" step="0.01" min="0" required>
                    <label for="kategorijas-select">Kategorija *</label>
                    <select id="kategorijas-select" name="id_kategorija" required>
                        <option value="" disabled selected>Izvēlieties kategoriju</option>
                    </select>
                    <label>Bildes *</label>
                    <input type="file" id="bildes" name="bildes[]" accept="image/*" multiple>
                    <div id="preview-container" style="display: flex; gap: 10px; margin-top: 10px;">
                        <img id="preview-bilde1" src="" />
                        <img id="preview-bilde2" src="" />
                        <img id="preview-bilde3" src="" />
                    </div>
                    <div id="preview-container" style="display: flex; gap: 10px;"></div>
                    <input type="hidden" id="prod_ID" name="id">
                </div>
                <button type="submit" name="nosutit" id="nosutit" class="btn submit active">Saglabāt</button>
            </form>
            <div class="bottom-info" id="produkta-informacija"></div>
        </div>
    </div>
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

<div class="modal" id="modal-kategorijas">
    <div class="modal-box">
        <div class="close-modal">
            <i class="fas fa-times"></i>
        </div>
        <h3>Produktu kategorija</h3>
        <div class="box">
            <form id="kategorijasForma" enctype="multipart/form-data">
                <div class="formElements">
                    <label>Nosaukums *</label>
                    <input type="text" id="nosaukums" name="nosaukums" required>
                    <label>Bilde *</label>
                    <input type="file" id="bilde" name="bilde" accept="image/*">
                    <img id="preview-image"
                        style="max-width: 200px; display: none; object-fit: cover; aspect-ratio: 16/9; border-radius: 8px">
                    <input type="hidden" id="kat_ID" name="id">
                </div>
                <button type="submit" name="nosutit" id="nosutit" class="btn submit active">Saglabāt</button>
            </form>
            <div class="bottom-info" id="kategorijas-informacija"></div>
        </div>
    </div>
</div>

<div id="notifikacija" class="notifikacija hidden">
    <div class="closeNotif">
        <i class="fas fa-times"></i>
    </div>
    <span id="notifikacijas-teksts"></span>
</div>