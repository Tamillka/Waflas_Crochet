<?php
if (!empty($_GET['session_id'])) {
    session_start();
    $session_id = $_GET['session_id'];

    require_once '../vendor/stripe-php-master/init.php';
    require_once 'config.php';


    try {
        $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
        $customer_email = $checkout_session->customer_details->email;

        $paymentIntent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);

        if ($paymentIntent->status == 'succeeded') {
            $transactionID = $paymentIntent->id;

            require '../assets/con_db.php';
            // $stmt = $savienojums->prepare("UPDATE waflas_pasutijumi SET Statuss = 'Apmaksāts' WHERE Pasutijums_ID = ?");
            // $stmt->bind_param("i", $_SESSION['pasutijums_id']);
            // $stmt->execute();

            $statusMsg = "<h2>Maksājums veiksmīgi apstrādāts!</h2>
            <p>Lai turpmāk iegūt PRO privilēģijas, veicot jaunu pieteikumu, izmantojiet šo e-pastu: <b>$customer_email</b></p>
            <p>Maksājuma reference: <b>$transactionID</b></p>";

            $id_pasutijums = $_SESSION['pasutijums_id'];

            $vaicajums = $savienojums->prepare("INSERT INTO waflas_maksajumi (ReferencesNum, Epasts, id_pasutijums) VALUES (?, ?, ?)");
            $vaicajums->bind_param("ssi", $transactionID, $customer_email, $id_pasutijums);
            $vaicajums->execute();
            $vaicajums->close();
            $savienojums->close();

        } else {
            $statusMsg = "Problēmas ar maksājuma apstrādi!";
        }
    } catch (Exception $e) {

        $statusMsg = "Nav iespējams iegūt maksājuma informāciju: " . $e->getMessage();
    }
    $_SESSION['pazinojums'] = $statusMsg;

}

header("location: ../");
?>