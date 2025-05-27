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

    if ($lietotajvards != "" && $vards != "" && $uzvards != "" && $epasts != "" && $talrunis != "" && $parole != "" && $parole1 != "") {
        if (str_ends_with($epasts, '@gmail.com')) {
            if ($parole == $parole1) {
                if (strlen($parole) > 8) {
                    if (preg_match('/[A-Z]/', $parole)) {

                        $existingUserQuery = "SELECT * FROM Waflas_lietotaji WHERE Epasts = '$epasts' OR Lietotajvards = '$lietotajvards'";
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
                        $_SESSION['pazinojums'] = "Parolē jāiekļauj vismaz viens lielais burts!";
                        header("location:../register.php");
                    }
                } else {
                    $_SESSION['pazinojums'] = "Parolei jābūt vismaz 8 simbolus garai!";
                    header("location:../register.php");
                }
            } else {
                $_SESSION['pazinojums'] = "Kļūda lietotāja reģistrācijā!";
                header("location:../register.php");
            }
        } else {
            $_SESSION['pazinojums'] = "E-pasts nav derīgs";
            header("location:../register.php");
        }
    }

    $savienojums->close();
    exit();
}

?>