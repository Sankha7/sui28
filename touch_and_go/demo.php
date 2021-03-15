<?php
require '../connection.php';

$merchant_id = $_SESSION['tngmid'];
$secret_key = $_SESSION['tngsk'];
$merchant_username = $_SESSION['merchant_username'];
$merchant_id1 = $_SESSION['merchant_id'];
$customer_name = $_POST['name'];
$customer_address = $_POST['address'];
$customer_postal = $_POST['postal'];
$customer_phone = $_POST['phone'];
$customer_email = $_POST['email'];
$order_notes = $_POST['notes'];
$product_id = $_POST['pid'];
$total = $_POST['total'];
$payment_status = 'pending';
$payment_method = $_POST['payment'];
$order_id = uniqid('ORD');
$_SESSION['order_id'] = $order_id;

$res = mysqli_query($con, "insert into orders(order_id,merchant_id, customer_name, customer_address, customer_postal, customer_phone, customer_email, order_notes, product_id, total, payment_status, payment_method) values
 ('$order_id','$merchant_id1', '$customer_name', '$customer_address', '$customer_postal', '$customer_phone', '$customer_email', '$order_notes', '$product_id', '$total', '$payment_status', '$payment_method')");


//Merchant's account information
// $merchant_id = "JT01";			//Get MerchantID when opening account with 2C2P
// $secret_key = "7jYcp4FxFdf0";	//Get SecretKey from 2C2P PGW Dashboard

//Transaction information
$payment_description  = 'Paying To ' . $merchant_username;
// $order_id  = time();
$currency = "702";
// $amount  = '000000002515';
$zero = "";
$amount = $total * 100;
$count_digit = strlen($amount);
$total_zero = 12 - $count_digit;
while ($total_zero > 0) {
	$zero = '0' . $zero;
	$total_zero -= 1;
}
$amount = $zero . $amount;

//Request information
$version = "8.5";
$payment_url = "https://demo2.2c2p.com/2C2PFrontEnd/RedirectV3/payment";
$result_url_1 = "http://localhost/ecomproj/touch_and_go/result.php";

//Construct signature string
$params = $version . $merchant_id . $payment_description . $order_id . $currency . $amount . $result_url_1;
$hash_value = hash_hmac('sha256', $params, $secret_key, false);	//Compute hash value

echo 'Payment information:';
echo '<html> 
	<body>
	<form id="myform" method="post" action="' . $payment_url . '">
		<input type="hidden" name="version" value="' . $version . '"/>
		<input type="hidden" name="merchant_id" value="' . $merchant_id . '"/>
		<input type="hidden" name="currency" value="' . $currency . '"/>
		<input type="hidden" name="result_url_1" value="' . $result_url_1 . '"/>
		<input type="hidden" name="hash_value" value="' . $hash_value . '"/>
    PRODUCT INFO : <input type="text" name="payment_description" value="' . $payment_description . '"  readonly/><br/>
		ORDER NO : <input type="text" name="order_id" value="' . $order_id . '"  readonly/><br/>
		AMOUNT: <input type="text" name="amount" value="' . $amount . '" readonly/><br/>
		<input id="submit" type="submit" name="submit" value="Confirm" />
	</form>
	</body>
	</html>';
