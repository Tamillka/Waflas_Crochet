<?php
require "../assets/con_db.php";
session_start();

// Pārbauda vai lietotājs ir Administrators vai Moderators
if (!isset($_SESSION['lietotajvardsTam']) || !in_array($_SESSION['lietotajaLoma'], ['Administrators', 'Moderators'])) {
    header("Location: login.php"); // Pāradresē uz login lapu, ja nav Administrators/Moderators
    exit();
}
?>

<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="../assets/script_admin.js" defer></script>
    <script src="../assets/pasutijumi_admin.js" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <title>Wafla's crochet</title>
</head>

<body>
    <div class="aside">
        <h1>Administrēšana</h1>
        <aside>
            <nav class="navbar">
                <div class="user">
                    <img src="/admin/database/get_profile_image.php" class="profile">
                    <p class="logout">
                        <?php echo $_SESSION['lietotajvardsTam']; ?>
                        <a href="logout.php"><i class="fas fa-power-off"></i></a>
                    </p>
                </div>
                <a href="./" class="btn <?php echo ($page == 'sakums' ? 'current' : ''); ?>">Sākumlapa</a>
                <a href="pasutijumi.php" id="orders"
                    class="btn <?php echo ($page == 'pasutijumi' ? 'current' : ''); ?>">Pāsūtījumi
                    <p class="redInfo" style="display: none;"></p>
                </a>
                <a href="produkti.php" class="btn <?php echo ($page == 'produkti' ? 'current' : ''); ?>">Produkti</a>
                <a href="atsauksmes.php"
                    class="btn <?php echo ($page == 'atsauksmes' ? 'current' : ''); ?>">Atsauksmes</a>
                <?php if ($_SESSION['lietotajaLoma'] === 'Administrators'): ?>
                    <a href="lietotaji.php" class="btn <?php echo ($page == 'lietotaji' ? 'current' : ''); ?>">Lietotāji</a>
                <?php endif; ?>
                <a href="iestatijumi_admin.php"
                    class="btn <?php echo ($page == 'iestatijumiAdmin' ? 'current' : ''); ?>"><i
                        class="fa-solid fa-gear"></i> Iestatījumi</a>
                <a href="../index.php" class="btn log"><i class="fas fa-sign-out-alt"></i> Uz galveno lapu</a>
            </nav>
        </aside>
    </div>
    <div id="menu-btn" class="fas fa-bars"></div>