<?php
require 'add_to_cart.php';
require 'connection.php';
require 'functions.php';
$cart_drop = '';
$pid = get_safe_value($con, $_POST['pid']);
$qty = get_safe_value($con, $_POST['qty']);
$type = get_safe_value($con, $_POST['type']);
// $qty=1;
// $type='remove';

$obj = new add_to_cart();

if ($type == 'add') {
    $obj->addProduct($pid, $qty);
    $prod_total = 0;
    foreach ($_SESSION['cart'] as $key => $val) {
        $productArr = get_product($con, '', '', $key);
        $price = $productArr[0]['price'];
        $qty = $val['qty'];
        $total = $price * $qty;
        $prod_total += $total;
    }
}

if ($type == 'remove') {

    $obj->removeProduct($pid, $qty);
    $prod_total = 0;
    foreach ($_SESSION['cart'] as $key => $val) {
        $productArr = get_product($con, '', '', $key);
        $price = $productArr[0]['price'];
        $qty = $val['qty'];
        $total = $price * $qty;
        $prod_total += $total;
    }
}

foreach ($_SESSION['cart'] as $key => $val) {
    $productArr = get_product($con, '', '', $key);
    $pname = $productArr[0]['name'];
    $mrp = $productArr[0]['mrp'];
    $price = $productArr[0]['price'];
    $image = $productArr[0]['image'];
    $qty = $val['qty'];
    $remove = "'remove'";
    $add = "'add'";
    $cart_drop .= '
        <div class="row">
                    <div class="col-7">

                        <!-- Showing Product details( only image and price ) in the cart  -->

                        <div class="row">
                            <div class="col-3">
                            <img style="padding-left: 10px;" height="50px" width="50px" src="' . PRODUCT_IMAGE_SITE_PATH . $image . '" alt="" srcset="">
                            </div>
                            <div class="col-9">
                            ' . $pname . '
                            <small><strong>$' . $price . '</strong></small>
                            </div>
                        </div>
                    
                    </div>

                            <!-- Showing quantity box  -->

                    <div class="col-5">
                        
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <button type="button" id="" class="btn btn-outline-secondary btn-number" onclick="manage_cart(' . $key . ', ' . $remove . ')">
                                    -
                                </button>
                            </span>
                            <input type="text" name="quant[1]" class="input-number" id="qty-input" value="' . $qty . '" min="1" max="10">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary btn-number" onclick="manage_cart(' . $key . ',' . $add . ')" >
                                    +
                                </button><span style="cursor: pointer;" onclick="manage_cart(' . $key . ', ' . $remove . ')">&nbsp;&times;</span>
                            </span>
                        </div>

                        
                    </div>

                    
                </div><br>';
}

$cart_drop_end = '<p>$' . $prod_total . '</p>';


$count = $obj->totalProduct();


if($count>0)
{
    $display="block";
}
else
{
    $display="none";
}

$cart='<button style="display: '.$display.';" onclick="openNav()" id="myBtn" title="Cart"><i class="fas fa-shopping-cart"></i> <a href="#"><span class="htc__qua">'.$count.'</span></a></button><input id="cnt" type="hidden" value="'.$count.'">';


// $data = '{
//     "name": "John Doe",
//     "occupation": "gardener"
// }';

echo json_encode(array('content' => $cart_drop, 'cart_end' => $cart_drop_end, 'cart' => $cart));
