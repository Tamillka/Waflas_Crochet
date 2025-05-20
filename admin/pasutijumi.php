<?php
$page = "pasutijumi";
require "header.php";
?>
<script src="../assets/pasutijumi_admin.js" defer></script>

<p class="svariga-info">Administrācijas sadaļa satur īpaši svarīgus datus, kas būtiski ietekmē sistēmas darbību un
    drošību. <br>
    Saglabājiet datus rūpīgi un izvairieties no nevajadzīgām izmaiņām vai dzēšanas. </p>

<div class="admin-main">
    <table>
        <tr>
            <th>ID</th>
            <th>Vards</th>
            <th>Uzvards</th>
            <th>E-pasts</th>
            <th>Pr. skaits</th>
            <th>Summa</th>
            <th>Statuss</th>
            <th>Datums</th>
            <th></th>

        </tr>
        <tbody id="pasutijumi"></tbody>
    </table>
</div>

<div class="modal" id="modal-pasutijumi">
    <div class="modal-box">
        <div class="close-modal">
            <i class="fas fa-times"></i>
        </div>
        <h3>Pasūtījums</h3>
        <div class="box">
            <form id="pasutijumaForma">
                <div class="formElements">
                    <label>Vards</label>
                    <input type="text" id="vards" name="vards" disabled>
                    <label>Uzvards</label>
                    <input type="text" id="uzvards" name="uzvards" disabled>
                    <label>E-pasts</label>
                    <input type="text" id="epasts" name="epasts" disabled>
                    <label>Preces</label>
                    <div class="produktusaraksts" id="pasutijuma-produkti"></div>
                    <label>Summa</label>
                    <input typa="number" name="summa" id="summa" step="0.01" min="0" disabled>
                    <label>Nomaini statusu *</label>
                    <select id="statuss" required>
                        <option value="Jauns">Jauns</option>
                        <option value="Apstiprināts">Apstiprināts</option>
                        <option value="Pabeigts">Pabeigts</option>
                        <option value="Noraidīts">Noraidīts</option>
                    </select>

                    <input type="hidden" id="pasut_ID" name="id">
                </div>
                <button type="submit" name="nosutit" id="nosutit" class="btn submit active">Saglabāt</button>
            </form>
            <div class="bottom-info" id="pasutijuma-informacija"></div>
        </div>
    </div>
</div>

<div id="notifikacija" class="notifikacija hidden">
    <div class="closeNotif">
        <i class="fas fa-times"></i>
    </div>
    <span id="notifikacijas-teksts"></span>
</div>