<?php 
$page = "kontakti";
require "header.php";
?>
<section id="hero-kontakti">
    <div class="left-info animate">
        <h1 class="animate">Sazinies ar mums</h1>
        <p class="animate">Mēs vienmēr esam gatavi Jums sniegt nepieciešamo atbalstu jebkurā situācijā. Neatkarīgi no tā, vai Jums ir jautājumi, mūsu komanda ir pieejama visu diennakti, lai nodrošinātu ātras un izsmeļošas atbildes</p>
        <button class="openPopupBtn btn" data-popup="popupKontakti">Sūtīt ziņu</button> <!-- Pievienots data-popup -->
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
                <p>Tel1: +371 67 777 111 <br> Tel2: +371 28 901 034
                </p>
                </div>
            </div>
            <div class="info-block medias">
           <a href="#"><i class="fa-brands fa-instagram media" ><div class="divider"></div></i></a>
           <a href="#"><i class="fa-brands fa-telegram media"><div class="divider"></div></i></a>
           <a href="#"><i class="fa-brands fa-facebook media"><div class="divider"></div></i></a>
           <a href="#"><i class="fa-brands fa-twitter media"><div class="divider"></div></i></a> 
            </div>
          </div>
</section>

<div id="popupKontakti" class="popup">
    <div class="popup-content">
        <span class="closeBtn">&times;</span>
        <h2>Sazinies ar mums</h2>
        <p>Sūti savu ziņu un mēs pēc iespējas ātrāk atbildēsim!</p>
    <form action = "" method = "post">
        <div class="box-container">
        <input type="text" name="vards" placeholder="Vārds" class="box" autocomplete="off" required>
        <input type="text" name="uzvards" placeholder="Uzvārds" class="box" autocomplete="off" required>
        </div>
        <div class="container">
        <input type="email" name="epasts" placeholder="E-pasts" class="box" autocomplete="off" required>
        <textarea name="zinojums" placeholder="Tava ziņa" class="box" required></textarea>
        <button type="submit" class="btn" name="nosutit">Nosūtīt ziņu</button>
        </div>
    </form>
    </div>
</div>

<script> document.addEventListener("DOMContentLoaded", function() {
        // Atrodam visas pogas, kuras atver popupus
        const openBtns = document.querySelectorAll(".openPopupBtn");
    
        // Pievienojam klikšķa notikumu katrai pogai
        openBtns.forEach(function(btn) {
            btn.addEventListener("click", function() {
                const popupId = btn.getAttribute("data-popup"); // Saņemam popup ID no 'data-popup'
                const popup = document.getElementById(popupId); // Atrodam popup elementu pēc tā ID
                if (popup) {
                    popup.style.display = "flex"; // Parādam popup
    
                    // Apstrādājam attēlu galeriju, ja tā eksistē popup
                    const thumbnails = popup.querySelectorAll(".thumbnail"); // Atrodam visas sīktēlus popup
                    const mainImage = popup.querySelector(".large-image"); // Atrodam galveno attēlu popup
    
                    if (thumbnails.length > 0 && mainImage) {
                        // Pievienojam klikšķa notikumu katram sīktēlam
                        thumbnails.forEach(thumbnail => {
                            thumbnail.addEventListener("click", function() {
                                // Nomainām galvenā attēla avotu
                                const largeImageSrc = thumbnail.getAttribute("data-large"); // Saņemam lielā attēla avotu no 'data-large'
                                mainImage.src = largeImageSrc; // Nomainām galvenā attēla avotu
    
                                // Noņemam 'active' klasi visiem sīktēliem
                                thumbnails.forEach(thumb => thumb.classList.remove("active"));
    
                                // Pievienojam 'active' klasi noklikšķinātajam sīktēlam
                                thumbnail.classList.add("active");
                            });
                        });
                    }
                }
            });
        });
    
        // Atrodam visas 'aizvērt' pogas
        const closeBtns = document.querySelectorAll(".closeBtn");
    
        // Pievienojam klikšķa notikumu katrai 'aizvērt' pogai
        closeBtns.forEach(function(closeBtn) {
            closeBtn.addEventListener("click", function() {
                const popup = closeBtn.closest(".popup"); // Atrodam popup elementu
                if (popup) {
                    popup.style.display = "none"; // Slēpjam popup
                }
            });
        });
    
        // Slēpjam popup, ja lietotājs klikšķina ārpus popup satura
        window.addEventListener("click", function(event) {
            if (event.target.classList.contains("popup")) {
                event.target.style.display = "none"; // Slēpjam popup
            }
        });
    });

</script>

<?php 
require "footer.php";
?>