<?php
session_start();
?>

<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <link rel="stylesheet" href="../assets/style_login.css">
    <script src="../assets/script.js" defer></script>
    <title>Login</title>
</head>

<body>
    <div class="box-container">
        <div class="box">
            <h2>Ielogoties sistēmā</h2>
            <form action="database/login_operation.php" method="POST">
                <input type="text" name="lietotajvards" placeholder="Lietotājvārds*" class="input" autocomplete="off"
                    required>
                <div class="password-wrapper">
                    <input type="password" name="parole" placeholder="Parole*" class="input" autocomplete="off"
                        id="id_password" required>
                    <i class="fa-solid fa-eye togglePassword"></i>
                </div>
                <?php
                if (isset($_SESSION['pazinojums'])) {
                    echo "<p class='login-notif'>" . $_SESSION['pazinojums'] . "</p>";
                    unset($_SESSION['pazinojums']);
                }
                ?>
                <button class="btn" name="ielogoties">IELOGOTIES</button>
                <p>Neesi vēl reģistrēts? <a href="register.php"><span id="now">Reģistrēties</span></a></p>
            </form>
        </div>
        <div class="box logo">
            <img src="../images/logo.png">
            <p>Doties uz <a href="../index.php"><span id="now">sākumlapu</span></a></p>
        </div>
    </div>

    <?php
    if (isset($_SESSION['pazinojumss'])):
        ?>
        <div class="popup popup-active" id="popup-message">
            <div class="popup-content">
                <div class="closeBtn" data-target="#popup-message">
                    <i class="fas fa-times"></i>
                </div>
                <div class="notif">
                    <?php
                    echo $_SESSION['pazinojumss'];
                    unset($_SESSION['pazinojumss']);
                    ?>
                </div>
            </div>
        </div>
        <?php
    endif;
    ?>

</body>

</html>