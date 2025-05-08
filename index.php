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
            <i class="fa-solid fa-star"></i> 5.0 (1,999)
        </p>
        <h1>Radīt, dalīties, iedvesmot: Tamborēšanas ceļojums sākas šeit!</h1>
        <p>Atklāj radošumu – iepērcies tamborēšanas paradīzē!</p>
        <a href="#produkcija"><button class="btn">Apskaties produkciju</button></a>
    </div>
</section>


<section id="jaunakie-pied" class="animate">


    <h2>Jaunākie piedāvājumi</h2>
    <!-- <h3>Skatīt visus <a href="#"><i class='fas fa-arrow-right'></i></a></h3> -->
    <div class="main-container">
        <div class="box-container">

            <?php require "produkcija_izvade.php" ?>

        </div>
    </div>
</section>

<?php require "prece_izvade.php" ?>

<div id="notifikacija" class="notifikacija hidden">
    <div class="closeNotif">
        <i class="fas fa-times"></i>
    </div>
    <span id="notifikacijas-teksts"></span>
</div>


<section id="par-mums">
    <div class="main-container">
        <div class="image-container">
            <img src="./images/about-img.jpg" class="animate">
        </div>
    </div>
    <div class="about">
        <div class="main-container">
            <h2 class="animate">Kas mēs esam?</h2>
            <div class="flex-text animate">
                <div class="about-points">
                    <div class="about-info"><i class="fa-solid fa-circle-info"></i>
                        <p>Wafla's crochet ir cilvēku grupa, kurus vieno aizraušanās ar adīšanu.</p>
                    </div>
                    <div class="about-info"><i class="fa-solid fa-heart-circle-bolt"></i>
                        <p>Mēs vēlamies klientiem atklāt, cik maigi un vienlaikus spēcīgi var būt adītie izstrādājumi,
                            piešķirot tiem īpašu siltumu un mīļumu.</p>
                    </div>
                </div>

                <div class="about-summary">
                    <p> Wafla's crochet piedāvā unikālu, kvalitatīvu produkciju, kur katrs tamborēts izstrādājums ir
                        rūpīgi veidots pēc sava dizaina. Mēs uzņemamies atbildību par produktu kvalitāti un ilgmūžību,
                        radot īpašas lietas, kas priecē un kalpo ilgtermiņā.</p> <a href="parmums.php"><button
                            class="btn">Lasīt vairāk</button></a>
                </div>
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

    <div class="headings">
        <h2>Produkcija</h2>
        <h3>Skatīt vairāk <a href="produkcija.php"><i class='fas fa-arrow-right'></i></a></h3>
    </div>
    <div class="main-container">
        <div class="box-container3">
            <?php
            require "assets/con_db.php";

            $kategorijasSQL = "SELECT * FROM Waflas_kategorija WHERE Radits = 1  ORDER BY Piev_datums DESC";
            $atlasaKategorijas = mysqli_query($savienojums, $kategorijasSQL);

            if (mysqli_num_rows($atlasaKategorijas) > 0) {
                while ($kategorija = mysqli_fetch_assoc($atlasaKategorijas)) {
                    // Base64 kodēšana no BLOB datiem
                    $imageData = base64_encode($kategorija['Bilde']);
                    $imageSrc = "data:image/jpeg;base64,{$imageData}";

                    echo "
               <div class='box animate' id='pirmais'>
                   <img src='{$imageSrc}' alt='Kategorijas attēls'>
                   <a href='produkcija.php?kategorija_id={$kategorija['Kategorijas_ID']}'><h3 id='KatNos'>{$kategorija['Nosaukums']}</h3></a>
               </div>
               ";
                }
            } else {
                echo "Nav nevienu piedāvājumu";
            }
            ?>
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
            <p class="atbilde">Mūsu produktus varat viegli iegādāties mūsu tiešsaistes veikalā. Vienkārši pārlūkojiet
                mūsu katalogu, pievienojiet vēlamās preces grozā un dodieties pie kases.</p>
        </div>
        <div class="jautajums animate">
            <div class="jautajums-bez-atb">
                <h3>Cik ātri es saņemšu savu pasūtījumu?</h3>
                <i class="fa-solid fa-plus"></i>
            </div>
            <p class="atbilde">Mēs centamies noformēt pasūtījumus pēc iespējas ātrāk, piegāde aizņems no 2 līdz 5 darba
                dienām.</p>
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
                <h3>Kurās valstīs Jūs piegādājat savu produkciju?</h3>
                <i class="fa-solid fa-plus"></i>
            </div>
            <p class="atbilde">Mēs piegādājam savu produkciju ES robežās.</p>
        </div>
        <div class="jautajums animate">
            <div class="jautajums-bez-atb">
                <h3>Vai ir iespēja veikt priekšpasūtījumu un izdomāt savu produktu?</h3>
                <i class="fa-solid fa-plus"></i>
            </div>
            <p class="atbilde">Tuvākajā nākotnē šī opcija būs pieejama.</p>
        </div>
    </div>
</section>

<section id="atsauksmes">
    <div class="main-container">
        <h2 class="animate">Ko par mums saka mūsu klienti?</h2>
        <p class="animate">Neticiet tikai mūsu vārdiem - skatiet, ko saka mūsu klienti! Pievienojieties apmierinātu
            klientu kopienai un izbaudiet atšķirību paši.</p>
        <button class="arrow left"><i class="fa-solid fa-arrow-left"></i></button>
        <div class="atsauksmes animate">
            <div class="atsauksme">
                <img src="./images/peson-atsauksme.jpg">
                <p><i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </p>
                <p><q>Es esmu sajūsmā par manu tamborēšanas produktu pirkumu! Kvalitāte ir izcila, un katrs produkts ir
                        rūpīgi un ar mīlestību veidots. Pasūtījums tika ātri piegādāts! Noteikti iepirkšos šeit vēlreiz.
                        Paldies!</q></p>
                <div class="divider"></div>
                <h3>Jone Doe</h3>
                <p id="country"><em>Latvija</em></p>
            </div>
            <div class="atsauksme">
                <img src="./images/peson-atsauksme.jpg">
                <p><i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </p>
                <p><q>Es esmu sajūsmā par manu tamborēšanas produktu pirkumu! Kvalitāte ir izcila, un katrs produkts ir
                        rūpīgi un ar mīlestību veidots. Pasūtījums tika ātri piegādāts! Noteikti iepirkšos šeit vēlreiz.
                        Paldies!</q></p>
                <div class="divider"></div>
                <h3>Jone Doe</h3>
                <p id="country"><em>Latvija</em></p>
            </div>
            <div class="atsauksme">
                <img src="./images/peson-atsauksme.jpg">
                <p><i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </p>
                <p><q>Es esmu sajūsmā par manu tamborēšanas produktu pirkumu! Kvalitāte ir izcila, un katrs produkts ir
                        rūpīgi un ar mīlestību veidots. Pasūtījums tika ātri piegādāts! Noteikti iepirkšos šeit vēlreiz.
                        Paldies!</q></p>
                <div class="divider"></div>
                <h3>Jone Doe</h3>
                <p id="country"><em>Latvija</em></p>
            </div>
            <div class="atsauksme">
                <img src="./images/peson-atsauksme.jpg">
                <p><i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </p>
                <p><q>Kvalitāte ir izcila, un katrs produkts ir rūpīgi un ar mīlestību veidots. Pasūtījums tika ātri
                        piegādāts! Noteikti iepirkšos šeit vēlreiz. Paldies!</q></p>
                <div class="divider"></div>
                <h3>Jone Doe</h3>
                <p id="country"><em>Latvija</em></p>
            </div>
            <div class="atsauksme">
                <img src="./images/peson-atsauksme.jpg">
                <p><i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </p>
                <p><q>Es esmu sajūsmā par manu tamborēšanas produktu pirkumu! Kvalitāte ir izcila, un katrs produkts ir
                        rūpīgi un ar mīlestību veidots. Pasūtījums tika ātri piegādāts! Noteikti iepirkšos šeit vēlreiz.
                        Paldies!</q></p>
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