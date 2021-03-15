<?php
require 'connection.php';
require 'functions.php';
require 'add_to_cart.php';

$url = $_SERVER['HTTP_HOST'];
$merchant_username = substr($url, 0, strpos($url, "."));
if($merchant_username == "www")
{
    $merchant_username = substr($url, 3, strpos($url, "."));
}



error_reporting(0);
// $merchant_username = $_GET['id'];
$res = mysqli_query($con, "select * from admin_users where username='$merchant_username'");
$row = mysqli_fetch_assoc($res);
$_SESSION['merchant_username'] = $merchant_username;
$_SESSION['logo'] = $row['logo'];
$_SESSION['spublick'] = $row['spublick'];
$_SESSION['sprivatek'] = $row['sprivatek'];
$_SESSION['merchant_id'] = $row['admin_id'];
$_SESSION['tngmid'] =  $row['tngmid'];
$_SESSION['tngsk'] = $row['tngsk'];
$merchant_id = $row['admin_id'];
$company_name = $row['company_name'];
$logo = $row['logo'];
$tagline = $row['tagline'];
$contact = $row['contact'];
// echo $_SESSION['merchant_id'];


$cat_res = mysqli_query($con, "SELECT distinct categories.* FROM categories,products WHERE categories.category_id = products.category_id AND categories.merchant_id = '$merchant_id'");
$cat_arr = array();
while ($row = mysqli_fetch_assoc($cat_res)) {
    $cat_arr[] = $row;
}

$obj = new add_to_cart();
$totalProduct = $obj->totalProduct();
// $totalProduct = 1;
if ($_SESSION['payment_status'] == 1) {
    $payment_status = '<div class="alert alert-primary" role="alert">PAYMENT SUCCESSFULL & ORDER IS PLACED</div>';
    unset($_SESSION['payment_status']);
} else if ($_SESSION['payment_status'] == 2) {
    $payment_status = '<div class="alert alert-warning" role="alert">PAYMENT PENDING. CALL FOR CONFIRMATION</div>';
    unset($_SESSION['payment_status']);
}
// else if ($_SESSION['payment_status'] == 0) {
//     $payment_status = "PAYMENT FAILED";
//     unset($_SESSION['payment_status']);
// }

if ($totalProduct == 0) {
    $display = "none";
} else {
    $display = "block";
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo SITE_PATH ?>css/style.css">
    <link rel="icon" href="https://sui28.com/images/favicon.ico">
    <!-- <link rel="icon" href="../images/favicon.ico"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_PATH ?>css/zoom.css">
    <title><?php echo $company_name; ?> 🚚 <?php echo $tagline; ?>🚚</title>
</head>

<body>


    <section class="header">
        <div class="text-center"><small><a href="https://sui28.com" style="color: white;">Powered By - Order.cc</a></small></div>
    </section>

    <div id="mySidenav" class="sidenav">
        <h6 id="heading">SHOPPING CART</h6>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <hr>
        <div class="items">
            <div class="container" id="items">
                <?php
                $prod_total = 0;
                foreach ($_SESSION['cart'] as $key => $val) {
                    $productArr = get_product($con, '', '', $key);
                    $pname = $productArr[0]['name'];
                    $mrp = $productArr[0]['mrp'];
                    $price = $productArr[0]['price'];
                    $image = $productArr[0]['image'];
                    $qty = $val['qty'];
                    $total = $price * $qty;
                    $prod_total += $total;
                ?>

                    <!-- All individual products  -->
                    <!-- The Modal -->
                    <div id="myModal" class="modal">
                        <span class="close">&times;</span>
                        <img class="modal-content" id="img01">
                        <div id="caption"></div>
                    </div>

                    <div class="row">
                        <div class="col-7">

                            <!-- Showing Product details( only image and price ) in the cart  -->

                            <div class="row">
                                <div class="col-3 text-center">
                                    <img style="padding-left: 10px;" height="50px" width="50px" src="<?php echo PRODUCT_IMAGE_SITE_PATH . $image ?>" alt="" srcset="">
                                </div>
                                <div class="col-9 text-center">
                                    <?php echo $pname ?>
                                    <small><strong>$<?php echo $price ?></strong></small>
                                </div>
                            </div>

                        </div>

                        <!-- Showing quantity box  -->

                        <div class="col-5">

                            <div class="input-group text-right">
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-outline-secondary btn-number" onclick="manage_cart('<?php echo $key ?>', 'remove')">
                                        -
                                    </button>
                                </span>
                                <input type="text" name="quant[1]" class="input-number" id="qty-input" value="<?php echo $qty ?>" min="1" max="10">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary btn-number" onclick="manage_cart(<?php echo $key ?>,'add')">
                                        +
                                    </button><span style="cursor: pointer;" onclick="manage_cart('<?php echo $key ?>', 'remove')">&nbsp;&times;</span>
                                </span>
                            </div>


                        </div>

                        <!-- <div class="col-1">
                            <span style="cursor: pointer;" onclick="manage_cart('<?php echo $key ?>', 'remove')">&nbsp;&times;</span>
                        </div> -->
                    </div><br>
                <?php
                }
                ?>

            </div>


            <!-- <ul> -->
            <!-- <div id="items"> -->
            <?php
            // $prod_total = 0;
            // foreach ($_SESSION['cart'] as $key => $val) {
            //     $productArr = get_product($con, '', '', $key);
            //     $pname = $productArr[0]['name'];
            //     $mrp = $productArr[0]['mrp'];
            //     $price = $productArr[0]['price'];
            //     $image = $productArr[0]['image'];
            //     $qty = $val['qty'];
            //     $total = $price * $qty;
            //     $prod_total += $total;
            ?>
            <!-- <li><img style="padding-left: 10px;" height="50px" width="50px" src="<?php //echo PRODUCT_IMAGE_SITE_PATH . $image 
                                                                                        ?>" alt="" srcset=""><?php //echo $pname 
                                                                                                                ?> x<?php //echo $qty 
                                                                                                                    ?> $<?php //echo $price 
                                                                                                                        ?> <span style="cursor: pointer;" onclick="manage_cart('<?php //echo $key 
                                                                                                                                                                                ?>', 'remove')">&nbsp;&times;</span></li><br> -->
            <?php
            // }
            ?>
            <!-- </div> -->
            <!-- </ul> -->
        </div>

        <div class="fixed-box">
            <div class="row text-center">
                <div class="col">
                    <p>Total</p>

                </div>
                <div class="col" id="cart_end">
                    <p>$<?php echo $prod_total; ?></p>
                </div>

            </div>
            <center>
                <a href="checkout">
                    <button style="width: 80%;" class="btn btn-outline-success">CHECKOUT</button>
                </a>
                <a href="javascript:void(0)" id="continue_shopping" onclick="closeNav()">CONTINUE SHOPPING</a>
            </center>
        </div>
    </div>

    <!-- Jumbotron part with logo and payment  -->

    <section class="header-grad">
        <div class="container container-small ">
            <div class="card-top text-center">
                <br>
                <a href="index"><img class="center" src="<?php echo SITE_PATH ?>/merchant/media/logos/<?php echo $logo; ?>" width="100%" alt=""></a>
                <!-- <p>We Accept Only Paypal</p> -->
            </div>
        </div>
    </section>


    <!-- upto this logo  -->

    <!-- Middle part with flag  -->

    <section class="">
        <div class="container container-small ">
            <div class="card-middle text-center">
                <h2><?php echo $company_name; ?></h2>
                <p>🚚 <?php echo $tagline; ?>🚚</p>
                <p><?php echo $payment_status ?></p>
            </div>
            <hr>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control mr-sm-2" type="text" name="search_text" id="search_text" placeholder="Search" aria-label="Search"><br>
                    <!-- <select class="form-control product_check" id="cat_val">
                        <option value="all">All Categories</option>
                        <?php
                        // foreach ($cat_arr as $list) { 
                        ?>
                            <option value="<?php //echo $list['category_id'] 
                                            ?>"><?php //echo $list['category'] 
                                                ?></option>
                        <?php //} 
                        ?>
                    </select> -->
                    <div class="form-group category1">
                        <div class="multipleSelection">
                            <div class="selectBox" onclick="showCheckboxes()">
                                <select class="form-control">
                                    <option>Select Category</option>
                                </select>
                                <div class="overSelect"></div>
                            </div>

                            <div id="checkBoxes">
                                <label class="form-check-label">
                                    <input type="checkbox" class="category_check1" value="<?php echo "all"; ?>" id="category"> <?php echo "All Categories"; ?>
                                </label>
                                <?php foreach ($cat_arr as $list) { ?>

                                    <label class="form-check-label">
                                        <input type="checkbox" class="category_check1" value="<?php echo $list['category_id'] ?>" id="category"> <?php echo $list['category'] ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Middle part with flag Ends  -->



    <section class="product-container">
        <div class="container container-small ">
            <div class="card-middle">


                <!-- Filters  -->

                <div class="filters">
                    <div class="row">
                        <div class="col">
                            <form class="form-inline">
                                <input class="form-control mr-sm-2 search" type="text" name="search_text" id="search_text1" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0 search" type="button"><i class="fas fa-search"></i></button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-dark" id="hidden" style="display:none;" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </form>
                        </div>
                        <div class="col">
                            <div class="form-group category">
                                <div class="multipleSelection">
                                    <div class="selectBox" onclick="showCheckboxes1()">
                                        <select class="form-control">
                                            <option>Select Category</option>
                                        </select>
                                        <div class="overSelect"></div>
                                    </div>

                                    <div id="checkBoxes1">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="category_check" value="<?php echo "all"; ?>" id="category"> <?php echo "All Categories"; ?>
                                        </label>
                                        <?php foreach ($cat_arr as $list) { ?>

                                            <label class="form-check-label">
                                                <input type="checkbox" class="category_check" value="<?php echo $list['category_id'] ?>" id="category"> <?php echo $list['category'] ?>
                                            </label>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <br>

                <!-- Filters End here  -->

                <!-- The Modal -->
                <div id="myModal" class="modal">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                </div>
                <!-- products -->
                <div id="result">
                    <?php
                    $get_product = get_product($con);
                    foreach ($get_product as $list) {
                        $desc = str_replace('.', '<br /><i class="fas fa-check-square"></i> ', $list["short_desc"]);
                        if ($list['delivery'] == 0) {
                            $disp = "none";
                        } else if ($list['delivery'] == 1) {
                            $disp = "block";
                        }
                    ?>
                        <div class="row">
                            <div class="col-4 text-center">
                                <div class="image-container">
                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $list['image'] ?>" alt="product" height="120px" width="120px" class="img-thumbnail" data-action="zoom">
                                    <div class="after"><i class="fas fa-search"></i></div>
                                </div>
                            </div>
                            <div class="col-8">
                                <h6><?php echo $list['name'] ?></h6>
                                <button style="display: <?php echo $disp ?>;" class="btn btn-outline-primary btn-sm" disabled>Free Delivery</button>
                                <small><i class="fas fa-check-square"></i> <?php echo $desc ?> </small>
                                <h5 class="text-right">$<?php echo $list['price'] ?></h5>
                                <button class="btn btn-success float-right" onclick="manage_cart(<?php echo $list['product_id'] ?>,'add')">+ Add</button>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                </div>
                <div id="overlay"></div>
            </div>
        </div>

    </section>
    <div id="cart">
        <button style="display: <?php echo $display ?>;" onclick="openNav()" id="myBtn" title="Cart"><i class="fas fa-shopping-cart"></i> <a href="#"><span class="htc__qua"><?php echo $totalProduct ?></span></a></button><input id="cnt" type="hidden" value="<?php echo $totalProduct ?>">
    </div>

    <!-- <div id="cart"></div> -->



    <!-- footer  -->
    <footer>
        <div class="text-center footer">
            <h5>Copyright 2021 © <?php echo $company_name; ?></h5>
            <p><?php echo $company_name; ?></p>
            <small><i class="fas fa-mobile"></i> <?php echo $contact ?></small>
            <p>Powered By - Order.cc</p>
        </div>
    </footer>


    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "380px";
            document.getElementById("myBtn").style.display = "none";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            var cnt = document.getElementById("cnt").value;
            if (cnt < 1) {
                document.getElementById("myBtn").style.display = "none";

            } else
                document.getElementById("myBtn").style.display = "block";

            console.log(cnt);
        }

        var show = true;
        var show1 = true;

        function showCheckboxes() {
            var checkboxes =
                document.getElementById("checkBoxes");

            if (show) {
                checkboxes.style.display = "block";
                show = false;
            } else {
                checkboxes.style.display = "none";
                show = true;
            }
        }

        function showCheckboxes1() {
            var checkboxes1 =
                document.getElementById("checkBoxes1");
            if (show1) {
                checkboxes1.style.display = "block";
                show1 = false;
            } else {
                checkboxes1.style.display = "none";
                show1 = true;
            }
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="<?php echo SITE_PATH ?>js/main.js"></script>
    <script src="<?php echo SITE_PATH ?>js/zoom.js"></script>
</body>

</html>