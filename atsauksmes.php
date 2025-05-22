<?php
$page = "atsauksmes";
require "header.php";
?>

<section id="atsauksmes-nosaukums">
    <div class="atsauksmesTop">
        <button class="btn active" data-target="#popupAtsauksmes" id="atsauksme">Pievienot atsauksmi</button>
    </div>
    <h2>Klientu atsauksmes</h2>
    <p><a href="index.php">Sākumlapa</a> <span>/</span> <a href="atsauksmes.php" id="now">Atsauksmes</a></p>
</section>
<p id="nosaukums-ats" class="animate"><em>Katrs mūsu klienta viedoklis ir atšķirīgs, to var apskatīt zemāk.</em></p>

<section id="visas-atsauksmes">
    <div class="main-container">
        <div class="box-container1">
            <?php require "admin/database/atsauksmes_izvade.php" ?>
        </div>
    </div>
</section>

<div id="popupAtsauksmes" class="popup">
    <div class="popup-content">
        <span class="closeBtn" data-target="#popupAtsauksmes">&times;</span> <!-- data-target pievienots -->
        <h2>Novērtē mūsu veikalu</h2>
        <form action="/admin/database/atsauksme_add.php" method="post">
            <div class="container">
                <div class="vertejums">
                    <label>Tavs vērtējums *</label>
                    <p class="stars">
                        <i class="fa-solid fa-star" data-value="1"></i>
                        <i class="fa-solid fa-star" data-value="2"></i>
                        <i class="fa-solid fa-star" data-value="3"></i>
                        <i class="fa-solid fa-star" data-value="4"></i>
                        <i class="fa-solid fa-star" data-value="5"></i>
                    </p>
                    <input type="hidden" name="vertejums" id="rating-value" value="">
                </div>
                <textarea name="teksts" placeholder="Atsauksmes apraksts" class="box" required></textarea>
                <button type="submit" class="btn active" name="pievienot">Pievienot</button>
            </div>
        </form>
    </div>
</div>

<div id="notifikacija" class="notifikacija hidden">
    <div class="closeNotif">
        <i class="fas fa-times"></i>
    </div>
    <span id="notifikacijas-teksts"></span>
</div>

<?php
if (isset($_SESSION['notif'])) {
    $notif = $_SESSION['notif'];

    $text = is_array($notif) ? $notif['text'] : $notif;
    $type = is_array($notif) && isset($notif['type']) ? $notif['type'] : 'success';

    echo "<script>
        window.onload = function() {
            showNotif(" . json_encode($text) . ", " . json_encode($type) . ");
        };
    </script>";
    unset($_SESSION['notif']);
}

require "footer.php";
?>