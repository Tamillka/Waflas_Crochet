<?php
$page = "atsauksmes";
require "header.php";
require "database/kopsavilkums_atsauksmes.php";
?>
<script src="../assets/atsauksmes_admin.js" defer></script>

<p class="svariga-info">Administrācijas sadaļa satur īpaši svarīgus datus, kas būtiski ietekmē sistēmas darbību un
    drošību. <br>
    Saglabājiet datus rūpīgi un izvairieties no nevajadzīgām izmaiņām vai dzēšanas. </p>

<div class="admin-main">
    <div class="top-panel">
        <div class="infoBlockReview">
            <p>Šajā sadaļā pieejamas apskatīšanai internetveikala <q>Wafla's crochet</q> klientu
                atsauksmes.</p>
            <i class="fa-solid fa-arrow-right"></i>
        </div>

        <div class="infoBoxCount">
            <h3>Vidējais vērtējums:</h3>
            <div class="block">
                <h2><?php echo $videjais; ?></h2>
                <p><?php echo $zvaigznesHTML; ?></p>
            </div>
        </div>

        <div class="infoBoxReviews">
            <div class="block">
                <h3>Atsauksmes kopā:</h3>
                <h2><?= $daudzums ?></h2>
            </div>
            <i class="fa-regular fa-star"></i>
        </div>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Lietotājvārds</th>
            <th>Bilde</th>
            <th>E-pasts</th>
            <th>Vērtējums</th>
            <th>Teksts</th>
            <th>Datums</th>
            <th></th>
        </tr>
        <tbody id="atsauksmes"></tbody>
    </table>
</div>

<div class="modal" id="modal-atsauksmes">
    <div class="modal-box">
        <div class="close-modal">
            <i class="fas fa-times"></i>
        </div>
        <h3>Klienta atsauksme</h3>
        <div class="box">
            <form id="atsauksmesForma">
                <div class="formElements">
                    <label>Vards</label>
                    <input type="text" id="vards" name="vards" disabled>
                    <label>Uzvards</label>
                    <input type="text" id="uzvards" name="uzvards" disabled>
                    <label>E-pasts</label>
                    <input type="text" id="epasts" name="epasts" disabled>
                    <label>Teksts</label>
                    <textarea id="teksts" disabled></textarea>
                    <input type="hidden" id="ats_ID" name="id">
                </div>
                <p id="vertejums"></p>
            </form>
        </div>
    </div>
</div>


<?php
require "footer.php";
?>