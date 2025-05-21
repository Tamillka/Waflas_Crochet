<?php
$page = "lietotaji";
require "header.php";

if (!isset($_SESSION['lietotajvardsTam']) || $_SESSION['lietotajaLoma'] !== 'Administrators') {
    header("Location: index.php");
    exit();
}
?>

<script src="../assets/lietotaji_admin.js" defer></script>

<p class="svariga-info">Administrācijas sadaļa satur īpaši svarīgus datus, kas būtiski ietekmē sistēmas darbību un
    drošību. <br>
    Saglabājiet datus rūpīgi un izvairieties no nevajadzīgām izmaiņām vai dzēšanas. </p>

<div class="admin-main">
    <div class="top-panel">
        <div id="searchField">
            <input type="text" id="searchInput" placeholder="Meklē lietotāju">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <button class="btn pievienot" id="new-btn"><i class="fas fa-plus"></i> Pievienot jaunu</button>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Lietotājvārds</th>
            <th>Vārds</th>
            <th>Uzvārds</th>
            <th>E-pasts</th>
            <th>Tālrunis</th>
            <th>Loma</th>
            <!-- <th>Datums</th> -->
            <th></th>
        </tr>
        <tbody id="lietotaji"></tbody>
    </table>
</div>

<div class="modal" id="modal-lietotaji">
    <div class="modal-box">
        <div class="close-modal">
            <i class="fas fa-times"></i>
        </div>
        <h3>Mājaslapas lietotājs</h3>
        <div class="box">
            <form id="lietotajaForma">
                <?php
                if (isset($_SESSION['pazinojums'])) {
                    echo "<p class='form-notif'>" . $_SESSION['pazinojums'] . "</p>";
                    unset($_SESSION['pazinojums']);
                }
                ?>
                <div class="formElements">
                    <label>Vārds *</label>
                    <input type="text" id="vards" name="vards" required>
                    <label>Uzvārds *</label>
                    <input type="text" id="uzvards" name="uzvards" required>
                    <label>Lietotājvārds *</label>
                    <input type="text" id="lietotajvards" name="lietotajvards" required>
                    <label>E-pasts *</label>
                    <input type="email" id="epasts" name="epasts" required>
                    <label>Tālrunis *</label>
                    <input type="text" id="talrunis" name="talrunis" required>
                    <label>Loma *</label>
                    <select id="loma" name="loma" required>
                        <option value="Administrators">Administrators</option>
                        <option value="Moderators">Moderators</option>
                    </select>
                    <label>Parole *</label>
                    <input type="password" id="parole" name="parole">
                    <div class="paroleBox" style="display: none">
                        <button class="btn passwordNew" id="changePassword">Mainīt paroli</button>
                        <input type="password" id="paroleNew" name="paroleNew" style="display: none">
                    </div>
                    <input type="hidden" id="liet_ID" name="id">
                </div>
                <button type="submit" name="nosutit" id="nosutit" class="btn submit active">Saglabāt</button>
            </form>
        </div>
    </div>
</div>

<div id="notifikacija" class="notifikacija hidden">
    <div class="closeNotif">
        <i class="fas fa-times"></i>
    </div>
    <span id="notifikacijas-teksts"></span>
</div>

<?php
require "footer.php";
?>