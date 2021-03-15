<?php
session_start();
$con = mysqli_connect("localhost", "sui28", "Kolkata@123My", "ecom");
// $con = mysqli_connect("localhost", "root", "", "ecom");

define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'] . '/sui28.com/');
define('SITE_PATH', 'https://sui28.com/');

// define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'] . '/ecomproj/');
// define('SITE_PATH', 'http://localhost/ecomproj/');

define('PRODUCT_IMAGE_SERVER_PATH', SERVER_PATH . 'merchant/media/products/');
define('PRODUCT_IMAGE_SITE_PATH', SITE_PATH . 'merchant/media/products/');
// define('LOGO_PATH', SITE_PATH . 'merchant/media/logos/');
