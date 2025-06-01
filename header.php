<?php
session_start();
$irIelogojies = isset($_SESSION['lietotajvardsTam']);
$lietotajaLoma = $_SESSION['lietotajaLoma'] ?? '';
require "admin/database/get_profile_info.php";
?>

<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/style_main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="../assets/script.js" defer></script>
    <script src="../assets/script_admin.js" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <title>Wafla's crochet</title>
</head>

<body>
    <header>
        <a href="./" class="logo"><img src="images/new_logo.jpg" alt=""></a>
        <nav class="navbar">
            <div class="navigacija">
                <a href="index.php" class="<?php echo ($page == 'galvena' ? 'current' : ''); ?>">Sākumlapa</a>
                <a href="produkcija.php" class="<?php echo ($page == 'produkcija' ? 'current' : ''); ?>">Produkcija</a>
                <a href="parmums.php" class="<?php echo ($page == 'parmums' ? 'current' : ''); ?>">Par mums</a>
                <a href="atsauksmes.php" class="<?php echo ($page == 'atsauksmes' ? 'current' : ''); ?>">Atsauksmes</a>
                <a href="kontakti.php" class="<?php echo ($page == 'kontakti' ? 'current' : ''); ?>">Kontakti</a>
            </div>

            <?php if ($irIelogojies): ?>
                <?php if ($lietotajaLoma === 'Klients'): ?>
                    <a href="grozs.php" class="<?php echo ($page == 'grozs' ? 'current' : ''); ?>"><i
                            class="fas fa-shopping-cart"></i></a>
                    <a id="settingButton"><i class="fas fa-user"></i></a>
                <?php elseif (in_array($lietotajaLoma, ['Administrators', 'Moderators'])): ?>
                    <a href="admin/index.php"><i class="fas fa-tools"></i></a>
                    <a href="admin/logout.php"><i class="fas fa-sign-out-alt"></i></a>
                <?php endif; ?>
            <?php else: ?>
                <a href="admin/login.php" class="<?php echo ($page == 'grozs' ? 'current' : ''); ?>"><i
                        class="fas fa-shopping-cart"></i></a>
                <a href="admin/login.php"><i class="fas fa-user"></i></a>
            <?php endif; ?>
            <script>
                const isLoggedIn = <?= $irIelogojies ? 'true' : 'false' ?>;
            </script>
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </header>
    <div class="profileBox">
        <div class="content">
            <p><?php echo $lietotajvards ?></p>
            <a href="iestatijumi.php">Iestatījumi</a>
            <a href="vesture.php">Pāsūtījumu vēsture</a>
            <a href="admin/logout.php"><i class="fas fa-sign-out-alt"></i> Izlogoties</a>
        </div>
    </div>

    <?php if (isset($_SESSION['pazinojums']) && !empty($_SESSION['pazinojums'])): ?>
        <div class="modal modal-active" id="modal-message">
            <div class="modal-box">
                <div class="closeBtn" data-target="#modal-message">
                    <i class="fas fa-times"></i>
                </div>
                <div class="notif">
                    <?= $_SESSION['pazinojums']; ?>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['pazinojums']); endif; ?>