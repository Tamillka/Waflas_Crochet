
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style_login.css">
    <title>Login</title>
</head>
<body>
    <div class="box-container">
    <div class="box register">   
        <h2>Reģistrēties sistēmā</h2>
        <div class="info">
        </div>
        <form method="POST">
        <input type="text" name="lietotajvards" placeholder="Lietotājvārds*" class="input" autocomplete="off" required>
         <input type="password" name="parole" placeholder="Parole*" class="input" autocomplete="off" required>
         <input type="password" name="paroleAtk" placeholder="Parole atkārtoti*" class="input" autocomplete="off" required>
         <button class = "btn" name="ielogoties">REĢISTRĒTIES</button> 
         <p>Esi jau reģistrēts? <a href="login.php"><span id="now">Ielogoties</span></a></p>
</form>
        </div>
        <div class="box logo1">
            <img src="images/logo.png">
            <p>Doties uz <a href="index.php"><span id="now">sākumlapu</span></a></p>
        </div>
    </div>
</body>
</html>