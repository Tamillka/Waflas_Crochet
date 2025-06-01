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

            $id_pasutijums = $_SESSION['pasutijums_id'];

            require '../assets/con_db.php';
            $statusMsg = "<i class='fa-regular fa-circle-check success'></i>
            <h3>Jūsu pasūtījums <span>#$id_pasutijums</span> ir veiksmīgi </br> noformēts!</h3>";

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