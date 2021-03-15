<?php
require 'connection.php';
require 'functions.php';

error_reporting(0);

$merchant_id = $_SESSION['merchant_id'];

$add = "'add'";

$output = '';

if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($con, $_POST["query"]);
    $query = "select * from products where name like '%" . $search . "%' and merchant_id=$merchant_id";
} else {
    $query = "select * from products where merchant_id=$merchant_id order by product_id desc";
}
$res = mysqli_query($con, $query);
if (mysqli_num_rows($res) > 0) {
    while ($list = mysqli_fetch_array($res)) {
        $desc = str_replace('.', '<br /><i class="fas fa-check-square"></i> ', $list["short_desc"]);
        if ($list['delivery'] == 0) {
            $disp = "none";
        } else if ($list['delivery'] == 1) {
            $disp = "block";
        }
        $output .= '<div class="row">
            <div class="col-4 text-center">
            <div class="image-container">
                <img height="120px" width="120px" src="' . PRODUCT_IMAGE_SITE_PATH . $list['image'] . '" alt="product" class="img-thumbnail" data-action="zoom">
                <div class="after"><i class="fas fa-search"></i></div>
            </div>
            </div>
            <div class="col-8">
                <h6>' . $list['name'] . '</h6>
                <button style="display: ' . $disp . ';" class="btn btn-outline-primary btn-sm" disabled>Free Delivery</button>
                <small> <i class="fas fa-check-square"></i> ' . $desc . ' </small>
                <h5 class="text-right">$' . $list['price'] . '</h5>
                <button class="btn btn-success float-right" onclick="manage_cart(' . $list['product_id'] . ',' . $add . ')">+ Add</button>

            </div>
        </div>
        <hr>';
    }
    echo $output;
} else {
    echo 'Data Not Found';
}
