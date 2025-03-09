<?php
session_start();
?>

<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/style_login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="../assets/script.js" defer></script>
    <title>Register</title>
</head>

<body>
    <div class="box-container">

        <div class="box register">
            <h2>Izveido savu kontu</h2>
            <form action="database/register_operation.php" method="POST">
                <div class="boxes">
                    <input type="text" name="vards" placeholder="Vārds*" class="input" autocomplete="off" required>
                    <input type="text" name="uzvards" placeholder="Uzvārds*" class="input" autocomplete="off" required>
                </div>
                <div class="boxes">
                    <input type="text" name="lietotajvards" placeholder="Lietotājvārds*" class="input"
                        autocomplete="off" required>
                    <input type="text" name="talrunis" placeholder="Tālrunis*" class="input" autocomplete="off"
                        required>
                </div>
                <input type="email" name="epasts" placeholder="E-pasts*" class="input" autocomplete="off" required>

                <div class="password-wrapper">
                    <input type="password" name="parole" placeholder="Parole*" class="input" autocomplete="off"
                        id="id_password" required>
                    <i class="fa-solid fa-eye togglePassword"></i>
                </div>
                <div class="password-wrapper">
                    <input type="password" name="paroleAtk" placeholder="Parole atkārtoti*" class="input"
                        id="id_password_confirm" autocomplete="off" required>
                    <i class="fa-solid fa-eye togglePassword"></i>
                </div>
                <?php
                if (isset($_SESSION['pazinojums'])) {
                    echo "<p class='login-notif'>" . $_SESSION['pazinojums'] . "</p>";
                    unset($_SESSION['pazinojums']);
                }
                ?>
                <button class="btn" name="registreties">REĢISTRĒTIES</button>
                <p>Esi jau reģistrēts? <a href="login.php"><span id="now">Ielogoties</span></a></p>
            </form>
        </div>
        <div class="box register logo">
            <h2>Sveiki!</h2>
            <h3>Reģistrējieties mūsu sistēmā un iegūstiet vairāk iespēju! <br> Veiciet pasūtījumus ar prieku!</h3>
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