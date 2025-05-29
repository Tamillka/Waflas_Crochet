<?php
require "header.php";


?>
<div class="main-container orders-margin-top">
    <h3>Mani pasūtījumi</h3>
    <div class="colorful-divider"></div>

    <div class="container">
        <?php
        require "admin/database/pasutijumu_vesture.php";
        foreach ($visi_pasutijumi as $p): ?>
            <div class="order-box">
                <div class="order-info">
                    <div class="info">
                        <h4>Pasūtījuma numurs: <em>#<?= str_pad($p['id'], 2, "0", STR_PAD_LEFT) ?></em></h4>
                        <h4>Pasūtījuma datums: <?= $p['datums']; ?></h4>
                        <p class="statuss"><?= $p['statuss']; ?></p>
                    </div>
                    <div class="info">
                        <p>Kopsumma: <em><?= number_format($p['summa'], 2) ?> EUR</em></p>
                        <p>Preču skaits: <em><?= $p['daudzums']; ?></em></p>
                    </div>
                </div>
                <div class="items">
                    <?php foreach ($p['produkti'] as $item): ?>
                        <div class="item">
                            <img src="<?= $item['bilde'] ?>" alt="produkts">
                            <div class="info">
                                <p><?= $item['vienibas_sk'] ?> gab. </br> <?= number_format($item['kopeja_cena'], 2) ?> EUR</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php
require "footer.php";
?>