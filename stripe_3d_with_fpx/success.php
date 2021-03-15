<?php
require 'vendor/autoload.php';
require '../connection.php';

$sprivatek = $_SESSION['sprivatek'];

\Stripe\Stripe::setApiKey("${sprivatek}");

//Taking the session form URL
$session_id = $_GET['session_id'];
$session = \Stripe\Checkout\Session::retrieve($session_id);

print_r($session);


//Creating an array of necessary things

$pay = array(
    //'item_number'   => json_encode($session->client_reference_id),
    'item_price'   => json_encode($session->amount_total),
    //'item_price_currency' => json_encode($session->currency),
    'payment_id'     => json_encode($session->payment_intent),
    'payment_status'     => json_encode($session->payment_status),
    'modified'   => date('Y-m-d H:i:s'),
    //'currency' => json_encode($session->currency)
);


// //Deleting the double quotes coming due to json encode

$itemPrice = trim($pay['item_price'], '"');
$payment_id = trim($pay['payment_id'], '"');
$payment_status = trim($pay['payment_status'], '"');
$modified = trim($pay['modified'], '"');
$order_id = $_SESSION['order_id'];
$itemPrice /= 100;

$sql = mysqli_query($con, "UPDATE orders SET total=$itemPrice, txn_id= '$payment_id', payment_status = '$payment_status', modified = '$modified' WHERE order_id = '$order_id'");


if ($payment_status == 'paid') {
    $_SESSION['payment_status'] = 1;
    unset($_SESSION['cart']);
    header("location:../index");
} else {
    $_SESSION['payment_status'] = 0;
    header("location:../index");
}

// //assigning to variables

// $paid_to_id = 0;
// $name = $_SESSION['Sankhadeep']['username'];
// $email = $_SESSION['Sankhadeep']['email'];;
// $itemPrice = $pay['item_price'] / 100;
// $currency = trim($pay['currency'], '"');
// $paidAmount = $itemPrice;