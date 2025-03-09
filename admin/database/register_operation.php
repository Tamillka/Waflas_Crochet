<?php
require "../../assets/con_db.php";

if (isset($_POST["registreties"])) {
    session_start();

    $lietotajvards = htmlspecialchars($_POST["lietotajvards"]);
    $vards = htmlspecialchars($_POST["vards"]);
    $uzvards = htmlspecialchars($_POST["uzvards"]);
    $epasts = htmlspecialchars($_POST["epasts"]);
    $talrunis = htmlspecialchars($_POST["talrunis"]);
    $parole = ($_POST["parole"]);
    $parole1 = ($_POST["paroleAtk"]);

    if ($lietotajvards != "" && $vards != "" && $uzvards != "" && $epasts != "" && $talrunis!="" && $parole != "" && $parole1 != "") {
        if ($parole == $parole1) {
            $existingUserQuery = "SELECT * FROM Waflas_lietotaji WHERE Lietotajvards = '$lietotajvards'";
            $existingUserResult = mysqli_query($savienojums, $existingUserQuery);

            if (mysqli_num_rows($existingUserResult) == 0) {
                $hashedPassword = password_hash($parole, PASSWORD_DEFAULT);

                $insertQuery = "INSERT INTO Waflas_lietotaji(Lietotajvards, Vards, Uzvards, Talrunis, Epasts, Parole) VALUES ('$lietotajvards', '$vards', '$uzvards', '$talrunis', '$epasts', '$hashedPassword')";
                $insertResult = mysqli_query($savienojums, $insertQuery);

                if ($insertResult) {
                    $_SESSION["lietotajvardsTam"] = $lietotajvards;
                    $_SESSION['pazinojumss'] = "Lietotājs veiksmīgi reģistrēts!";
                    header("location:../login.php");
                } 
            } else {
                $_SESSION['pazinojums'] = "Tāds lietotājs jau eksistē!";
                header("location:../register.php");
            }
        } else {
            $_SESSION['pazinojums'] = "Kļūda lietotāja reģistrācijā!";
            header("location:../register.php");
        }
    } 

    $savienojums->close();
    exit();
}

?>