<?php
$page = "iestatijumiAdmin";
require "header.php";
require "../assets/con_db.php";


$lietotajs_id = $_SESSION['lietotajs_id'];
$vaicajums = $savienojums->prepare("SELECT * FROM Waflas_lietotaji WHERE Lietotajs_ID = ?");
$vaicajums->bind_param("i", $lietotajs_id);
$vaicajums->execute();
$rezultats = $vaicajums->get_result();
$lietotajs = $rezultats->fetch_assoc();

?>
<p class="svariga-info">Administrācijas sadaļa satur īpaši svarīgus datus, kas būtiski ietekmē sistēmas darbību un
    drošību. <br>
    Saglabājiet datus rūpīgi un izvairieties no nevajadzīgām izmaiņām vai dzēšanas. </p>

<div class="main-container margin-top">
    <div class="edit-container">
        <div class="profile-box">
            <div class="image">
                <img src="/admin/database/get_profile_image.php" alt="Profila bilde">
                <form id="photoForm" method="POST" action="/admin/database/edit_profile.php"
                    enctype="multipart/form-data">
                    <input type="file" name="bilde" id="bildeInput" accept="image/*" style="display: none;">
                    <i class="fa-solid fa-plus" id="uploadTrigger"></i>
                    <input type="hidden" name="page" value="<?php echo $page; ?>">
                </form>
            </div>
            <h3>Sveiki, <span><?php echo $lietotajvards; ?></span></h3>
            <button type="button" name="change" class="btn secondary-button" onclick="toggleForm()">Mainīt
                paroli</button>
            <form method="POST" class="hidden" id="passwordForm" action="/admin/database/edit_profile.php">
                <div class="form">
                    <input type="password" name="currentpassword" placeholder="Pašreizējā parole" required>
                    <input type="password" name="jauna" placeholder="Jauna parole" required>
                    <input type="password" name="jaunaatkartoti" placeholder="Atkārtoti" required>
                    <input type="hidden" name="page" value="<?php echo $page; ?>">
                    <button type="submit" name="change_password" class="btn">Saglabāt</button>
                </div>
            </form>
        </div>
        <div class="change-info">
            <div class="head">
                <h3>Profila iestatījumi</h3>
            </div>
            <form class="user-info-form" method="POST" action="/admin/database/edit_profile.php">
                <div class="name-group">
                    <div class="form-group">
                        <label for="vards">Vārds</label>
                        <input type="text" name="vards" value=<?php echo htmlspecialchars($lietotajs['Vards']) ?>>
                    </div>

                    <div class="form-group">
                        <label for="uzvards">Uzvārds</label>
                        <input type="text" name="uzvards" value=<?php echo htmlspecialchars($lietotajs['Uzvards']) ?>>
                    </div>
                </div>

                <div class="form-group">
                    <label for="lietotajvards">Lietotājvārds</label>
                    <input type="text" name="lietotajvards" value=<?php echo htmlspecialchars($lietotajs['Lietotajvards']) ?>>
                </div>

                <div class="form-group">
                    <label for="epasts">E-pasts</label>
                    <input type="email" name="epasts" value=<?php echo htmlspecialchars($lietotajs['Epasts']) ?>>
                </div>

                <div class="form-group">
                    <label for="telefons">Telefona numurs</label>
                    <input type="tel" name="telefons" value=<?php echo htmlspecialchars($lietotajs['Talrunis']) ?>>
                </div>

                <div class="buttons-bottom">
                    <button class="btn main-button" name="rediget">Saglabāt izmaiņas</button>
                    <button class="btn delete-button" id="deleteBtn" name="dzest">Dzēst kontu</button>
                </div>
                <input type="hidden" name="page" value="<?php echo $page; ?>">
            </form>
            <form id="deleteForm" method="POST" action="/admin/database/delete_profile.php">
                <input type="hidden" name="dzest" value="1">
            </form>
        </div>
    </div>
</div>

<div id="notifikacija" class="notifikacija hidden">
    <div class="closeNotif">
        <i class="fas fa-times"></i>
    </div>
    <span id="notifikacijas-teksts"></span>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteBtn = document.getElementById("deleteBtn");

        if (deleteBtn) {
            deleteBtn.addEventListener("click", function (e) {
                e.preventDefault();

                if (confirm("Vai tiešām vēlaties dzēst savu profilu?")) {
                    fetch("/admin/database/delete_profile.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: "dzest=1",
                    })
                        .then(response => response.text())
                        .then(data => {
                            // console.log("Atbilde no servera:", data);
                            showNotif("Profils tika veiksmīgi dzēsts!");

                            setTimeout(function () {
                                window.location.href = "/admin/login.php";
                            }, 3000);
                        })
                        .catch(error => {
                            alert("Kļūda dzēšot kontu!");
                            console.error("Kļūda:", error);
                        });
                }
            });
        }
    });
</script>

<?php

if (isset($_SESSION['notif'])) {
    $notif = $_SESSION['notif'];

    $text = is_array($notif) ? $notif['text'] : $notif;
    $type = is_array($notif) && isset($notif['type']) ? $notif['type'] : 'success';

    echo "<script>
        window.onload = function() {
            showNotif(" . json_encode($text) . ", " . json_encode($type) . ");
        };
    </script>";
    unset($_SESSION['notif']);
}

// require "footer.php";
?>

<?php
require "footer.php";
?>