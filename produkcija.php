<?php
$page = "produkcija";
require "header.php";
?>

<section id="produkti-nosaukums">
    <div class="filtrudala">
        <a class="btn-sm" id="filterBtn"><i class="fa-solid fa-filter"></i> Filtri</a>
        <div id="searchField">
            <input type="text" id="searchInput" placeholder="Meklēšana">
            <!-- <a class="btn-sm" id="searchBtn"><i class="fa-solid fa-magnifying-glass"></i></a> -->
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>

    </div>
    <h2>Mūsu produkcija</h2>
    <p><a href="index.php">Sākumlapa</a> <span>/</span> <a href="produkcija.php" id="now">Produkcija</a></p>
</section>
<section id="visaProdukcija">
    <div class="main-container">
        <div class="box-container animate" id="preces-container">
        </div>
    </div>
</section>



<?php
require "footer.php";
?>