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

<div id="notifikacija" class="notifikacija hidden">
    <div class="closeNotif">
        <i class="fas fa-times"></i>
    </div>
    <span id="notifikacijas-teksts"></span>
</div>