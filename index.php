<?php 
$page = "galvena";
require "header.php";
?>


<section id="hero">
    <div class="main-container">
        <h2>Wafla's crochet</h2>
        <p><i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i> 5.0 (1,999)</p>
        <h1>Radīt, dalīties, iedvesmot: Tamborēšanas ceļojums sākas šeit!</h1>
        <p>Atklāj radošumu – iepērcies tamborēšanas paradīzē!</p>
        <a href="#produkcija"><button class="btn">Apskaties produkciju</button></a>
    </div>
</section>


<section id="jaunakie-pied" class="animate">
  <div class="main-container">
   
      <h2>Jaunākie piedāvājumi</h2>
      <!-- <h3>Skatīt visus <a href="#"><i class='fas fa-arrow-right'></i></a></h3> -->
    
    <div class="box-container">
      <div class="box animate">
        <img src="/images/rabbit.jpg">
        <button class="openPopupBtn btn" data-popup="popupRabbit">Atvērt</button>
        <h3>Pretty rabbit</h3>
        <p>Natural wool</p>
        <h3>35€</h3>
      </div>
      <div class="box animate">
        <img src="/images/dino.jpg">
        <button class="openPopupBtn btn" data-popup="popupDino">Atvērt</button>
        <h3>Pretty dino</h3>
        <p>Soft threads</p>
        <h3>25€</h3>
      </div>
      <div class="box animate">
        <img src="/images/minion.jpg">
        <button class="openPopupBtn btn" data-popup="popupMinion">Atvērt</button>
        <h3>Happy minion</h3>
        <p>Soft threads</p>
        <h3>50€</h3>
      </div>
      <div class="box animate">
        <img src="/images/snake.jpg">
        <button class="openPopupBtn btn" data-popup="popupSnake">Atvērt</button>
        <h3>Long snake</h3>
        <p>Soft threads</p>
        <h3>15€</h3>
      </div>
    </div>
  </div>
</section>

<!-- Popup Rabbit -->
<div id="popupRabbit" class="popup">
  <div class="popup-content">
    <span class="closeBtn">&times;</span>
    <div class="image-gallery">
      <img id="mainImage" src="/images/rabbit.jpg" class="large-image">
      <div class="thumbnails">
      <img src="/images/rabbit.jpg" class="thumbnail active" data-large="/images/rabbit.jpg">
        <img src="/images/rabbit1.jpg" class="thumbnail" data-large="/images/rabbit1.jpg">
        <img src="/images/rabbit2.webp" class="thumbnail" data-large="/images/rabbit2.webp">
        <img src="/images/rabbit3_thumb.jpg" class="thumbnail" data-large="/images/rabbit3_large.jpg">
      </div>
    </div>
    <h3>Pretty Rabbit</h3>
    <p>Šis zaķis ir izgatavots no dabīgas vilnas dzijas. Neskatoties uz tā materiālu, tas ir mīksts un patīkams pieskārienam.</p>
    <h3>35€</h3>
    <button class="btn">Pievienot grozam</button>
  </div>
</div>

<!-- Popup Dino -->
<div id="popupDino" class="popup">
<div class="popup-content">
    <span class="closeBtn">&times;</span>
    <div class="image-gallery">
      <img id="mainImage" src="/images/dino.jpg" class="large-image">
      <div class="thumbnails">
      <img src="/images/dino.jpg" class="thumbnail active" data-large="/images/dino.jpg">
        <img src="/images/dino1.jpg" class="thumbnail" data-large="/images/dino1.jpg">
        <img src="/images/dino2.jpg" class="thumbnail" data-large="/images/dino2.jpg">
        <img src="/images/dino3.webp" class="thumbnail" data-large="/images/dino3.webp">
      </div>
    </div>
    <h3>Pretty Dino</h3>
    <p>Dino ir izgatavots no plīša dzijas. Materiāls ir pats ļoti mīksts un jebkuram var palikt par mīļāko mantu.</p>
    <h3>35€</h3>
    <button class="btn">Pievienot grozam</button>
  </div>
</div>

<!-- Popup Minion -->
<div id="popupMinion" class="popup">
  <div class="popup-content">
    <span class="closeBtn">&times;</span>
    <h2>Happy Minion</h2>
    <p>This is a happy minion.</p>
  </div>
</div>

<!-- Popup Snake -->
<div id="popupSnake" class="popup">
  <div class="popup-content">
    <span class="closeBtn">&times;</span>
    <h2>Long Snake</h2>
    <p>This is a long snake.</p>
  </div>
</div>

<section id="par-mums">
    <div class="main-container">
        <div class="image-container">
            <img src="/images/about-img.jpg" class="animate">
        </div>
    </div>
    <div class="about">
        <div class="main-container">
            <h2 class="animate">Kas mēs esam?</h2>
            <div class="flex-text animate">
                <div class="about-points">
                    <div class="about-info"><i class="fa-solid fa-circle-info"></i> <p>Wafla's crochet ir cilvēku grupa, kurus vieno aizraušanās ar adīšanu.</p></div>
                    <div class="about-info"><i class="fa-solid fa-heart-circle-bolt"></i> <p>Mēs vēlamies klientiem atklāt, cik maigi un vienlaikus spēcīgi var būt adītie izstrādājumi, piešķirot tiem īpašu siltumu un mīļumu.</p></div>
                </div>
               
                <div class="about-summary"><p> Wafla's crochet piedāvā unikālu, kvalitatīvu produkciju, kur katrs tamborēts izstrādājums ir rūpīgi veidots pēc sava dizaina. Mēs uzņemamies atbildību par produktu kvalitāti un ilgmūžību, radot īpašas lietas, kas priecē un kalpo ilgtermiņā.</p> <a href="parmums.php"><button class="btn">Lasīt vairāk</button></a></div>
            </div>
        </div>
    </div>
</section>
<section id="kvalitate">
<div class="main-container">
        <ul>
        <li class="kval-box">
            <h2>4,500+</h2>
            <p>Priecīgie klienti</p>
</li>
        <li class="kval-box">
            <h2>5.0</h2>
            <p>Zvaigžņu vērtējums</p>
</li>
        <li class="kval-box">
            <h2>24/7</h2>
            <p>Klientu apkalpošana</p>
</li>
        <li class="kval-box">
            <h2>7 dienas</h2>
            <p>Ātra un droša piegāde</p>
</li>
</ul>

<ul aria-hidden="true;">
        <li class="kval-box">
            <h2>4,500+</h2>
            <p>Priecīgie klienti</p>
</li>
        <li class="kval-box">
            <h2>5.0</h2>
            <p>Zvaigžņu vērtējums</p>
</li>
        <li class="kval-box">
            <h2>24/7</h2>
            <p>Klientu apkalpošana</p>
</li>
        <li class="kval-box">
            <h2>7 dienas</h2>
            <p>Ātra un droša piegāde</p>
</li>
</ul>
</div>
</section>
<div class="divider"></div>

<section id="produkcija" class="animate">
  <div class="main-container">
    <div class="headings">
      <h2>Produkcija</h2>
      <h3>Skatīt vairāk <a href="#"><i class='fas fa-arrow-right'></i></a></h3>
      </div>
    <div class="box-container">
      <div class="box animate">
        <img src="/images/rabbit.jpg">
        <button class="btn">Atvērt</button>
        <h3>Pretty rabbit</h3>
        <p>Natural wool</p>
        <h3>35€</h3>
      </div>
      <div class="box animate">
        <img src="/images/dino.jpg">
        <button class="btn">Atvērt</button>
        <h3>Pretty dino</h3>
        <p>Soft threads</p>
        <h3>25€</h3>
      </div>
      <div class="box animate">
        <img src="/images/minion.jpg">
        <button class="btn">Atvērt</button>
        <h3>Happy minion</h3>
        <p>Soft threads</p>
        <h3>50€</h3>
      </div>
      <div class="box animate">
        <img src="/images/snake.jpg">
        <button class="btn">Atvērt</button>
        <h3>Long snake</h3>
        <p>Soft threads</p>
        <h3>15€</h3>
      </div>
      <div class="box animate">
        <img src="/images/rabbit.jpg">
        <button class="btn">Atvērt</button>
        <h3>Pretty rabbit</h3>
        <p>Natural wool</p>
        <h3>35€</h3>
      </div>
      <div class="box animate">
        <img src="/images/dino.jpg">
        <button class="btn">Atvērt</button>
        <h3>Pretty dino</h3>
        <p>Soft threads</p>
        <h3>25€</h3>
      </div>
      <div class="box animate">
        <img src="/images/minion.jpg">
        <button class="btn">Atvērt</button>
        <h3>Happy minion</h3>
        <p>Soft threads</p>
        <h3>50€</h3>
      </div>
      <div class="box animate">
        <img src="/images/snake.jpg">
        <button class="btn">Atvērt</button>
        <h3>Long snake</h3>
        <p>Soft threads</p>
        <h3>15€</h3>
      </div>
    </div>
  </div>
</section>


<section id="jautajumi">
    <div class="main-container">
        <div class="jautajums animate">
            <div class="jautajums-bez-atb">
                <h3>Kā es varu iegādāties jūsu tamborētos produktus?</h3>
                <i class="fa-solid fa-plus"></i>
            </div>
            <p class="atbilde">Mūsu produktus varat viegli iegādāties mūsu tiešsaistes veikalā. Vienkārši pārlūkojiet mūsu katalogu, pievienojiet vēlamās preces grozā un dodieties pie kases.</p>
        </div>
        <div class="jautajums animate">
            <div class="jautajums-bez-atb">
                <h3>Kā es varu iegādāties jūsu tamborētos produktus?</h3>
                <i class="fa-solid fa-plus"></i>
            </div>
            <p class="atbilde">Mūsu produktus varat viegli iegādāties mūsu tiešsaistes veikalā. Vienkārši pārlūkojiet mūsu katalogu, pievienojiet vēlamās preces grozā un dodieties pie kases.</p>         
        </div>
        <div class="jautajums animate">
            <div class="jautajums-bez-atb">
                <h3>Kādus materialus jūs lietojat?</h3>
                <i class="fa-solid fa-plus"></i>
            </div>
            <p class="atbilde">Mēs izmantojam plīša dziju adīšanai, kā arī vilnu un pušķus.</p>
        </div>
        <div class="jautajums animate">
            <div class="jautajums-bez-atb">
                <h3>Kā es varu iegādāties jūsu tamborētos produktus?</h3>
                <i class="fa-solid fa-plus"></i>
            </div>
            <p class="atbilde">Mūsu produktus varat viegli iegādāties mūsu tiešsaistes veikalā. Vienkārši pārlūkojiet mūsu katalogu, pievienojiet vēlamās preces grozā un dodieties pie kases.</p>      
        </div>
        <div class="jautajums animate">
            <div class="jautajums-bez-atb">
                <h3>Kā es varu iegādāties jūsu tamborētos produktus?</h3>
                <i class="fa-solid fa-plus"></i>
            </div>
            <p class="atbilde">Mūsu produktus varat viegli iegādāties mūsu tiešsaistes veikalā. Vienkārši pārlūkojiet mūsu katalogu, pievienojiet vēlamās preces grozā un dodieties pie kases.</p>
        </div>
    </div>
</section>

<section id="atsauksmes">
    <div class="main-container">
        <h2 class="animate">Ko par mums saka mūsu klienti?</h2>
        <p class="animate">Neticiet tikai mūsu vārdiem - skatiet, ko saka mūsu klienti! Pievienojieties apmierinātu klientu kopienai un izbaudiet atšķirību paši.</p>
            <button class="arrow left"><i class="fa-solid fa-arrow-left"></i></button>
            <div class="atsauksmes animate">
                <div class="atsauksme">
        <img src="/images/peson-atsauksme.jpg">
        <p><i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i></p>
        <p><q>Es esmu sajūsmā par manu tamborēšanas produktu pirkumu! Kvalitāte ir izcila, un katrs produkts ir rūpīgi un ar mīlestību veidots. Pasūtījums tika ātri piegādāts! Noteikti iepirkšos šeit vēlreiz. Paldies!</q></p>
        <div class="divider"></div>
        <h3>Jone Doe</h3>
        <p id="country"><em>Latvija</em></p>
                </div>
                <div class="atsauksme">
        <img src="/images/peson-atsauksme.jpg">
        <p><i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i></p>
        <p><q>Es esmu sajūsmā par manu tamborēšanas produktu pirkumu! Kvalitāte ir izcila, un katrs produkts ir rūpīgi un ar mīlestību veidots. Pasūtījums tika ātri piegādāts! Noteikti iepirkšos šeit vēlreiz. Paldies!</q></p>
        <div class="divider"></div>
        <h3>Jone Doe</h3>
        <p id="country"><em>Latvija</em></p>
                </div>
                <div class="atsauksme">
        <img src="/images/peson-atsauksme.jpg">
        <p><i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i></p>
        <p><q>Es esmu sajūsmā par manu tamborēšanas produktu pirkumu! Kvalitāte ir izcila, un katrs produkts ir rūpīgi un ar mīlestību veidots. Pasūtījums tika ātri piegādāts! Noteikti iepirkšos šeit vēlreiz. Paldies!</q></p>
        <div class="divider"></div>
        <h3>Jone Doe</h3>
        <p id="country"><em>Latvija</em></p>
                </div>
                <div class="atsauksme">
        <img src="/images/peson-atsauksme.jpg">
        <p><i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i></p>
        <p><q>Kvalitāte ir izcila, un katrs produkts ir rūpīgi un ar mīlestību veidots. Pasūtījums tika ātri piegādāts! Noteikti iepirkšos šeit vēlreiz. Paldies!</q></p>
        <div class="divider"></div>
        <h3>Jone Doe</h3>
        <p id="country"><em>Latvija</em></p>
                </div>
                <div class="atsauksme">
        <img src="/images/peson-atsauksme.jpg">
        <p><i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i></p>
        <p><q>Es esmu sajūsmā par manu tamborēšanas produktu pirkumu! Kvalitāte ir izcila, un katrs produkts ir rūpīgi un ar mīlestību veidots. Pasūtījums tika ātri piegādāts! Noteikti iepirkšos šeit vēlreiz. Paldies!</q></p>
        <div class="divider"></div>
        <h3>Jone Doe</h3>
        <p id="country"><em>Latvija</em></p>
                </div>
            </div>
            <button class="arrow right"><i class="fa-solid fa-arrow-right"></i></button>
    </div>
</section>



<?php 
require "footer.php";
?>