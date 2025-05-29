<?php
$page = "kontakti";
require "header.php";

?>


<section id="hero-kontakti">
    <div class="left-info animate">
        <h1 class="animate">Sazinies ar mums</h1>
        <p class="animate">Mēs vienmēr esam gatavi Jums sniegt nepieciešamo atbalstu jebkurā situācijā. Neatkarīgi no
            tā, vai Jums ir jautājumi, mūsu komanda ir pieejama visu diennakti, lai nodrošinātu ātras un izsmeļošas
            atbildes.</p>
        <button class="btn active" data-target="#popupKontakti">Sūtīt ziņu</button> <!-- data-target aizstāts -->
    </div>
    <div class="right-kontakti animate">
        <h2 class="animate">Kontaktinformācija</h2>
        <div class="info-block animate">
            <i class="fa-solid fa-location-dot"></i>
            <div class="texts">
                <h3>Our office</h3>
                <p>Brīvības iela 4, Latvija, LV-3401, Rīga</p>
            </div>
        </div>
        <div class="info-block animate">
            <i class="fa-regular fa-clock"></i>
            <div class="texts">
                <h3>Our hours of work</h3>
                <p>Darba dienās: 9:00-18:00 <br> Brīvdienās: 10:00-15:00</p>
            </div>
        </div>
        <div class="info-block animate">
            <i class="fa-solid fa-phone-volume"></i>
            <div class="texts">
                <h3>Our phone number</h3>
                <p>Tel1: +371 67 777 111 <br> Tel2: +371 28 901 034</p>
            </div>
        </div>
        <div class="info-block medias">
            <a href="#"><i class="fa-brands fa-instagram media">
                    <div class="divider"></div>
                </i></a>
            <a href="#"><i class="fa-brands fa-telegram media">
                    <div class="divider"></div>
                </i></a>
            <a href="#"><i class="fa-brands fa-facebook media">
                    <div class="divider"></div>
                </i></a>
            <a href="#"><i class="fa-brands fa-twitter media">
                    <div class="divider"></div>
                </i></a>
        </div>
    </div>
</section>


<div id="popupKontakti" class="popup">
    <div class="popup-content">
        <span class="closeBtn" data-target="#popupKontakti">&times;</span> <!-- data-target pievienots -->
        <h2>Sazinies ar mums</h2>
        <p>Sūti savu ziņu un mēs pēc iespējas ātrāk atbildēsim!</p>
        <form action="" method="post">
            <div class="box-container">
                <input type="text" name="vards" placeholder="Vārds" class="box" autocomplete="off" required>
                <input type="text" name="uzvards" placeholder="Uzvārds" class="box" autocomplete="off" required>
            </div>
            <div class="container">
                <input type="email" name="epasts" placeholder="E-pasts" class="box" autocomplete="off" required>
                <textarea name="zinojums" placeholder="Tava ziņa" class="box" required></textarea>
                <button type="submit" class="btn active" name="nosutit">Nosūtīt ziņu</button>
            </div>
        </form>
    </div>
</div>





<?php
require 'assets/mail.php';
?>



<?php
require "footer.php";
?>