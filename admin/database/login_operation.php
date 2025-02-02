<?php
require "../../assets/con_db.php";

if(isset($_POST['ielogoties'])){
    session_start();

    $lietotajs = htmlspecialchars($_POST['lietotajvards']);
    $parole = $_POST['parole'];

    $vaicajums = $savienojums->prepare("SELECT * FROM Waflas_lietotaji WHERE Lietotajvards = ?" );
    $vaicajums->bind_param("s", $lietotajs);
    $vaicajums->execute();
    $rezultats = $vaicajums->get_result();
    $lietotajs = $rezultats->fetch_assoc();

    if($lietotajs && password_verify($parole, $lietotajs['Parole'])){
        $_SESSION['lietotajvardsTam'] = $lietotajs['Lietotajvards'];
        $_SESSION['lietotajaLoma'] = $lietotajs['Loma'];

        echo "Veiksmīga autorizācija";
    }else{
        $_SESSION['pazinojums'] = "Nepareizs lietotājvārds vai parole";
    }

    header("Location: ../");
    $vaicajums->close();
    $savienojums->close();
}
?>