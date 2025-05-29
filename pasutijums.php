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
                        <label for="pilseta">Pilsēta</label>
                        <input type="text" name="pilseta" id="pilseta" required>
                    </div>
                    <div class="form-group">
                        <label for="adrese">Adrese</label>
                        <input type="text" name="adrese" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="omniva_terminal">Omniva pakomāts</label>
                    <select name="omniva_terminal" id="omniva_terminal" required>
                        <option value="">Nav pilsētas</option>
                    </select>
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
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const pilsetaInput = document.getElementById('pilseta');
        const terminalSelect = document.getElementById('omniva_terminal');

        pilsetaInput.addEventListener('blur', () => {
            const city = pilsetaInput.value.trim();

            if (city.length < 2) return;

            fetch('/assets/checkout/omniva_config.php?city=' + encodeURIComponent(city))
                .then(res => res.text())
                .then(html => {
                    terminalSelect.innerHTML = html;
                })
                .catch(err => {
                    terminalSelect.innerHTML = '<option value="">Neizdevās ielādēt pakomātus</option>';
                    console.error(err);
                });
        });
    });
</script>