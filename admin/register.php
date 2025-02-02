
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style_login.css">
    <title>Login</title>
</head>
<body>
    <div class="box-container">
    
    <div class="box register">   
        <h2>Izveido savu kontu</h2>
        <div class="info">
        </div>
        <form method="POST">
            <div class="boxes">
        <input type="text" name="vards" placeholder="Vārds*" class="input" autocomplete="off" required>
        <input type="text" name="uzvards" placeholder="Uzvārds*" class="input" autocomplete="off" required>
            </div>
        <input type="email" name="epasts" placeholder="E-pasts*" class="input" autocomplete="off" required>
        <input type="text" name="talrunis" placeholder="Tālrunis*" class="input" autocomplete="off" required>
         <input type="password" name="parole" placeholder="Parole*" class="input" autocomplete="off" required>
         <input type="password" name="paroleAtk" placeholder="Parole atkārtoti*" class="input" autocomplete="off" required>
         <button class = "btn" name="registreties">REĢISTRĒTIES</button> 
         <p>Esi jau reģistrēts? <a href="login.php"><span id="now">Ielogoties</span></a></p>
</form>
        </div>
        <div class="box register logo">
        <h2 id="noItalic">Sveiki!</h2>
        <h3>Reģistrējieties mūsu sistēmā un iegūstiet vairāk iespēju! <br> Jūs varēsiet pievienot preces savam grozam un veikt pasūtījumus!</h3>
            <img src="../images/logo.png">
            <p>Doties uz <a href="../index.php"><span id="now">sākumlapu</span></a></p>
        </div>
        </div>

</body>
</html>