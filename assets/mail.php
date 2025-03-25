<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/PHPMailer.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if (isset($_POST["nosutit"])) {

    try {
        //Server settings
        $mail->CharSet = "UTF-8";
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kvaldarbs5@gmail.com';
        $mail->Password = 'ntny gjqg zuim dmxr';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        //Recipients
        $mail->setFrom('kvaldarbs5@gmail.com', 'Waflas crochet');
        $mail->addAddress('kvaldarbs5@gmail.com', 'Waflas crochet');

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Ziņa - Waflas crochet';
        $mail->Body = 'Ziņas sūtītāja vārds, uzvārds: <b>' . $_POST['vards'] . ' ' . $_POST['uzvards'] . '</b> <br>
        Ziņas sūtītāja e-pasts: <b>' . $_POST['epasts'] . '</b> <br>
        Ziņojums: <b>' . $_POST['zinojums'] . '</b>';

        $mail->send();
        echo "<div id='pazinojums'>
        <p>Ziņa nosūtīta! Sazināsimies ar Jums vēlāk!</p>
        </div>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const mesage = document.getElementById("pazinojums");

        // Pārbaudām, vai paziņojuma elements eksistē
        if (mesage) {
            // Ja paziņojums eksistē, gaidām 3 sekundes un tad sākam lēnu animāciju
            setTimeout(function () {
                mesage.classList.add("hidden"); // Pievienojam "hidden" klasi, kas samazina opacity
            }, 2000);
        }
    });
</script>