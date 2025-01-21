<?php 
$page = "produkcija";
require "header.php";
?>


<section id="atsauksmes-nosaukums">
    <h2>Mūsu produkcija</h2>
    <p><a href="index.php">Sākumlapa</a> <span>/</span> <a href="produkcija.php" id="now">Produkcija</a></p>
</section>
<section id="visaProdukcija">
    <div class="main-container">
        <div class="box-container">
        <?php require "produkcija_izvade.php" ?>
        </div>
    </div>
</section>

<?php require "prece_izvade.php" ?>