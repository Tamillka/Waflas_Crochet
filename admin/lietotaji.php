<?php
$page = "lietotaji";
require "header.php";

if (!isset($_SESSION['lietotajvardsTam']) || $_SESSION['lietotajaLoma'] !== 'Administrators') {
    header("Location: index.php");
    exit();
}
?>