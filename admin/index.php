<?php
$page = "sakums";
require "header.php";
require "database/diagramma.php";
require "database/kopsavilkums.php";
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../assets/diagramma.js" defer></script>

<p class="svariga-info">Administrācijas sadaļa satur īpaši svarīgus datus, kas būtiski ietekmē sistēmas darbību un
    drošību. <br>
    Saglabājiet datus rūpīgi un izvairieties no nevajadzīgām izmaiņām vai dzēšanas. </p>

<div class="wrapper">
    <div class="top">
        <div class="info-box">
            <div class="box1">
                <div class="info">
                    <h2 class="modified"><?php echo $pasutijumi; ?></h2>
                    <h3>Pasūtījumi kopā</h3>
                </div>
                <div class="icona">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
            </div>
            <div class="box2">
                <a href="pasutijumi.php">Skatīties vairāk <i class="fas fa-arrow-right"></i></a>
            </div>

        </div>
        <div class="info-box">
            <div class="box1">
                <div class="info">
                    <h2 class="modified"><?php echo $produkti; ?></h2>
                    <h3>Produkti veikalā</h3>
                </div>
                <div class="icona">
                    <i class="fa-solid fa-store"></i>
                </div>
            </div>
            <div class="box2">
                <a href="produkti.php">Skatīties vairāk <i class="fas fa-arrow-right"></i></a>
            </div>

        </div>
        <div class="info-box">
            <div class="box1">
                <div class="info">
                    <h2 class="modified"><?php echo $atsauksmes; ?></h2>
                    <h3>Klientu atsauksmes</h3>
                </div>
                <div class="icona">
                    <i class="fa-solid fa-star"></i>
                </div>
            </div>
            <div class="box2">
                <a href="atsauksmes.php">Skatīties vairāk <i class="fas fa-arrow-right"></i></a>
            </div>

        </div>
        <div class="info-box">
            <div class="box1">
                <div class="info">
                    <h2 class="modified"><?php echo $lietotaji; ?></h2>
                    <h3>Reģistrētie lietotāji</h3>
                </div>
                <div class="icona">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <div class="box2">
                <a href="lietotaji.php">Skatīties vairāk <i class="fas fa-arrow-right"></i></a>
            </div>

        </div>
    </div>
    <div class="divider"></div>
    <div class="columns">
        <div class="block">
            <h3>Pasūtījumi pēdējas nedēļas laikā</h3>
            <canvas id="pasutijumuDiagramma" max-height="250"></canvas>
        </div>
        <div class="block">
            <h3>Pēdējie pasūtījumi</h3>
            <table>
                <tr>
                    <th>Vārds, uzvārds</th>
                    <th>Datums</th>
                    <th>Statuss</th>
                </tr>
                <?php
                $pasut_SQL = "SELECT * FROM Waflas_pasutijumi ORDER BY Pasut_datums DESC LIMIT 6";
                $atlasa_pasut_SQL = mysqli_query($savienojums, $pasut_SQL);

                while ($pasutijums = mysqli_fetch_array($atlasa_pasut_SQL)) {
                    echo "
                    <tr>
                    <td>{$pasutijums['Vards']} {$pasutijums['Uzvards']}</td>
                  
                    <td>" . date("d.m.Y. H:i", strtotime($pasutijums['Pasut_datums'])) . "</td>
                      <td>{$pasutijums['Statuss']}</td>
                    </tr>
                    ";
                }

                ?>
            </table>
        </div>
    </div>
    <div class="top modif">
        <div class="info-box">
            <h4>Nopēlnīts pēdējā <br /> <span>dienā</span></h4>
            <h3><?php echo $ienemums_diena; ?> €</h3>
        </div>
        <div class="info-box">
            <h4>Nopēlnīts pēdējā <br /> <span>nedēļā</span></h4>
            <h3><?php echo $ienemums_nedela; ?> €</h3>
        </div>
        <div class="info-box">
            <h4>Nopēlnīts pēdējā <br /> <span>menesī</span></h4>
            <h3><?php echo $ienemums_menesis; ?> €</h3>
        </div>
        <div class="info-box">
            <h4>Nopēlnīts pēdējā <br /> <span>gadā</span></h4>
            <h3><?php echo $ienemums_gads; ?> €</h3>
        </div>
    </div>
    <div class="divider"></div>
    <div class="columns">
        <div class="block">
            <h3>Jaunākie klienti</h3>
            <table>
                <tr>
                    <th>Vārds, uzvārds</th>
                    <th>E-pasts</th>
                    <th>Bilde</th>
                </tr>
                <?php
                $jaunie_klienti_SQL = "SELECT * FROM waflas_lietotaji WHERE Loma = 'Klients' ORDER BY Piev_datums DESC LIMIT 3";
                $atlasa_klientus = mysqli_query($savienojums, $jaunie_klienti_SQL);

                while ($klients = mysqli_fetch_assoc($atlasa_klientus)) {
                    $vards_uzvards = htmlspecialchars($klients['Vards'] . " " . $klients['Uzvards']);
                    $epasts = htmlspecialchars($klients['Epasts']);

                    if (!empty($klients['Bilde'])) {
                        $base64 = base64_encode($klients['Bilde']);
                        $bilde_src = "data:image/jpeg;base64,$base64";
                    } else {
                        $bilde_src = "../images/profile.png";
                    }


                    echo "<tr>";
                    echo "<td>$vards_uzvards</td>";
                    echo "<td>$epasts</td>";
                    echo "<td><img src='$bilde_src'></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div class="block row">
            <div class="info-box">
                <h4>Klienti sistēmā</h4>
                <h3><?php echo $klienti; ?></h3>
            </div>
            <div class="info-box">
                <h4>Moderatori sistēmā</h4>
                <h3><?php echo $moderatori; ?></h3>
            </div>
            <div class="info-box">
                <h4>Administratori sistēmā</h4>
                <h3><?php echo $administratori; ?></h3>
            </div>
        </div>
    </div>
</div>

<?php
require "footer.php";
?>