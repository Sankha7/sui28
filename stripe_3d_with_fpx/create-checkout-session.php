<?php
require 'vendor/autoload.php';
require '../connection.php';

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
  $url = "https://";
else
  $url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];
$url .= '/stripe_3d_with_fpx';

$merchant_username = $_SESSION['merchant_username'];
$logo = $_SESSION['logo'];
$sprivatek = $_SESSION['sprivatek'];
$merchant_id = $_SESSION['merchant_id'];
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
 ('$order_id','$merchant_id', '$customer_name', '$customer_address', '$customer_postal', '$customer_phone', '$customer_email', '$order_notes', '$product_id', '$total', '$payment_status', '$payment_method')");


\Stripe\Stripe::setApiKey("${sprivatek}");
header('Content-Type: application/json');
$YOUR_DOMAIN = $url;

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['fpx'],
  'customer_email' => $customer_email,
  'line_items' => [[
    'price_data' => [
      'currency' => 'myr',
      'unit_amount' => $total * 100,
      'product_data' => [
        'name' => $merchant_username,
        'images' => ["https://sui28.com/merchant/media/logos/${logo}"],
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.php',
  'success_url' => $YOUR_DOMAIN . '/success.php?session_id={CHECKOUT_SESSION_ID}',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.php',
]);
echo json_encode(['id' => $checkout_session->id]);


////////
// $amount = $_POST['amount'];
// $wtId = $_POST['wtId'];
// $email = $_POST['email'];
// $item_name = $_POST['itemName'];

// \Stripe\Stripe::setApiKey('sk_test_51HDq4zJF5rzXJzJOXWNmTEN3Uq4grX4toecZukrzay6REZ6eKhsXbxOTW9lA4r0cLSYUwjhw7vYf5ZOUndIn7DH400strk8bAi');
// header('Content-Type: application/json');
// $YOUR_DOMAIN = 'http://localhost/coursegek/stripe_3d';

// $checkout_session = \Stripe\Checkout\Session::create([
// 'payment_method_types' => ['card'],
//   'customer_email' => $email,
//   'client_reference_id' => $wtId,
//   'line_items' => [
//     [
//       'price_data' => [
//         'currency' => 'usd',
//         'unit_amount' => $amount * 100,
//         'product_data' => [
//           'name' => 'CourseGEK',
//           'images' => ["https://projects.dotlinkertech.com/coursegek/images/logo.png"],
//           'description' => $item_name,
//         ],
//       ],
//       'quantity' => 1,
//     ]
//   ],
//   'mode' => 'payment',
//   'success_url' => $YOUR_DOMAIN . '/success.php',
//   'success_url' => $YOUR_DOMAIN . '/success.php?session_id={CHECKOUT_SESSION_ID}',
//   'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
// ]);