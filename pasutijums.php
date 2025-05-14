<?php
$page = "grozs";
require "header.php";
?>
<div class="main-container margin-top">
    <form class="pasutijums-content" method="POST" action="/payment/checkout.php">
        <div class="change-info pasutijums-info">
            <div class="head">
                <h3>Pasūtījuma noformēšana</h3>
            </div>
            <div class="user-info-form">
                <div class="name-group">
                    <div class="form-group">
                        <label for="vards">Vārds</label>
                        <input type="text" name="vards" required>
                    </div>

                    <div class="form-group">
                        <label for="uzvards">Uzvārds</label>
                        <input type="text" name="uzvards" required>
                    </div>
                </div>
                <div class="name-group">
                    <div class="form-group">
                        <label for="epasts">E-pasts</label>
                        <input type="email" name="epasts" required>
                    </div>

                    <div class="form-group">
                        <label for="telefons">Telefona numurs</label>
                        <input type="tel" name="telefons" required>
                    </div>
                </div>
                <div class="name-group">
                    <div class="form-group">
                        <label for="valsts">Valsts</label>
                        <input type="valsts" name="valsts" required>
                    </div>

                    <div class="form-group">
                        <label for="pilseta">Pilsēta</label>
                        <input type="text" name="pilseta" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="adrese">Adrese</label>
                    <input type="text" name="adrese" required>
                </div>
            </div>
        </div>
        <div class="total-box pasutijums">
            <h3>Kopā apmaksai:</h3>
            <div class="colorful-divider"></div>
            <p class="total">23.25€</p>
            <button class="btn main-button" type="submit" name="submit_order">Doties uz apmaksu</button>
        </div>
    </form>
</div>
<?php
require "footer.php";
?>