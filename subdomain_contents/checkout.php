<?php
require 'connection.php';
require 'functions.php';
error_reporting(0);
$products_id = '';
$status = '';
$disabled = '';

$merchant_id = $_SESSION['merchant_id'];
$res = mysqli_query($con, "select * from admin_users where admin_id='$merchant_id'");
$row = mysqli_fetch_assoc($res);
$_SESSION['merchant_id'] = $row['admin_id'];
$merchant_id = $row['admin_id'];
$company_name = $row['company_name'];
$logo = $row['logo'];
$tagline = $row['tagline'];
$contact = $row['contact'];

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
  <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <title><?php echo $company_name; ?> 🚚 <?php echo $tagline; ?>🚚</title>
</head>

<body>
  <section class="header">
    <div class="text-center"><small><a href="https://sui28.com" style="color: white;">Powered By - Order.cc</a></small></div></small></div>
  </section>


  <!-- Jumbotron part with logo and payment  -->

  <section class="header-grad">
    <div class="container container-small ">
      <div class="card-top text-center">
        <br>
        <a href="index"><img class="center" src="<?php echo SITE_PATH ?>merchant/media/logos/<?php echo $logo; ?>" width="100%" alt=""></a>
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
      </div>
      <hr>
    </div>
  </section>




  <section class="product-container">
    <div class="container container-small ">
      <div class="card-middle">
        <div class="card">
          <h6>Billing & Shipping</h6>
          <br>
          <form>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-4 col-form-label">Name / 名</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="name" name="name" placeholder="name">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-4 col-form-label">Street Address</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="address" name="address" placeholder="Street Address">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-4 col-form-label">Postal/ Zip</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="postal" name="postal" placeholder="Postal Code/ Zip">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-4 col-form-label">Mobile Number </label>
              <div class="col-sm-8">
                <input type="number" class="form-control" id="phone" name="phone" placeholder="Mobile Number">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-4 col-form-label">Email Address</label>
              <div class="col-sm-8">
                <input type="Email" class="form-control" id="email" name="email" placeholder="Email Address">
              </div>
            </div>
            <!-- <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-4 col-form-label">Delivery Date</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputPassword3" placeholder="Delivery Date">
                            </div>
                          </div> -->

            <p style="color:red;">NOTE: Our driver will contact you 1 hour before delivery.<br>
            </p>
            <br>
            <h5>Additional information</h5>
            <br>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-4 col-form-label">Order notes(optional)</label>
              <div class="col-sm-8">
                <textarea name="notes" class="form-control" id="notes" cols="30" rows="5"></textarea>
              </div>
            </div>





        </div>
        <br>
        <h6>Your Order</h6>
        <br>
        <div class="card">
          <table class="table">
            <thead>
              <tr class="text-center">
                <th scope="col">PRODUCT</th>
                <th scope="col">QTY</th>
                <th scope="col">SUBTOTAL</th>
              </tr>
            </thead>
            <tbody>
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
                $products_id = $key . ',' . $products_id;
              ?>
                <tr class="text-center">
                  <td><?php echo $pname ?></td>
                  <td><?php echo $qty ?></td>
                  <td>$<?php echo $price ?></td>

                </tr>
              <?php
              }
              ?>

              <tr class="text-center">
                <th scope="row"></th>
                <td>TOTAL</td>
                <td><strong>$<?php echo $prod_total ?></strong></td>

              </tr>
            </tbody>
          </table>

          <br>

          <div class="custom-control custom-radio">
            <input type="radio" name="payment" id="customRadio1" name="customRadio" class="custom-control-input" value="FPX">
            <label class="custom-control-label" for="customRadio1">Pay with FPX</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="payment" id="customRadio2" name="customRadio" class="custom-control-input" value="TNG">
            <label class="custom-control-label" for="customRadio2">Pay with Touch and Go</label>
          </div>
          <div id="textboxes1" style="display: none">
            <small>After clicking “Place Order”, you will be redirected to complete your purchase securely.</small>
          </div>
          <!-- <div class="custom-control custom-radio">
                        <input type="radio" name="payment" id="customRadio2" name="customRadio" class="custom-control-input" value="cod">
                        <label class="custom-control-label" for="customRadio2">Cash On Delivery</label>
                      </div> -->
          <input type="hidden" name="pid" value="<?php echo $products_id; ?>">
          <input type="hidden" name="total" value="<?php echo $prod_total; ?>">
          <!-- <div id="textboxes2" style="display: none">
                        <small>Pay with cash upon delivery</small>
                     </div> -->
          <?php
          if ($prod_total == 0) {
            $disabled = 'disabled';
          }
          ?>
          <button value="submit" name="submit" class="btn btn-outline-success" <?php echo $disabled ?>>Place Order</button>

          <br>

          <small>
            Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.
          </small>








        </div>






        </form>
      </div>
    </div>

  </section>
  <div id="tngform" style="display: none;">
  </div>






  <!-- footer  -->
  <footer>
    <div class="text-center footer">
      <h5>Copyright 2021 © <?php echo $company_name; ?></h5>
      <p><?php echo $company_name; ?></p>
      <small><i class="fas fa-mobile"></i> <?php echo $contact ?></small>
      <p>Powered By - Order.cc</p>
    </div>
  </footer>

  <!-- <form>
                        <input type="hidden" name="wtId" value="<?php echo $walletTransactionId; ?>">
                        <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                        <input type="hidden" name="itemName" value="Wallet Add">
                        <input type="hidden" name="email" value="<?php echo $_SESSION['Sankhadeep']['email']; ?>">
                        <button name="submit" class="btn btn-success" value="submit">Pay Using Stripe</button>
                    </form> -->

  <!-- <script>
    $(function() {
    $('input[name="type"]').on('click', function() {
        if ($(this).val() == 'pay') {
            $('#textboxes1').show();
            $('#textboxes2').hide();
        }
        else {
            $('#textboxes1').hide();
            $('#textboxes2').show();

        }
    });
});
</script> -->
  <?php
   $spublick = $_SESSION['spublick'];
  ?>
  <script type="text/javascript">
    // Create an instance of the Stripe object with your publishable API key
    var stripe = Stripe("<?php echo $spublick ?>");
    var checkoutButton = document.getElementById("checkout-button");
    jQuery(function() {

      jQuery('form').on('submit', function(e) {

        var paymentMethod = $('input[name="payment"]:checked').val();


        e.preventDefault();
    if (paymentMethod == "FPX") {
      jQuery.ajax({
        type: 'post',
        url: 'stripe_3d_with_fpx/create-checkout-session.php',
        data: jQuery('form').serialize(),
        success: function(session) {
          return stripe.redirectToCheckout({
            sessionId: session.id
          });
        }
      });
    }
    else {
      console.log(paymentMethod);
      jQuery.ajax({
        type: 'post',
          url: 'touch_and_go/demo.php',
          data: jQuery('form').serialize(),
          success: function(data) {
            console.log(data);
            $("#tngform").html(data);
            jQuery('#submit').click();
          }
      });
    }
  });
});
  </script>


  <script>
    // jQuery(function() {

    //   jQuery('form').on('submit', function(e) {
    //     var paymentMethod = $('input[name="payment"]:checked').val();
    //     e.preventDefault();
    //     $.ajax({
    //       type: 'post',
    //       url: '../touch_and_go/demo.php',
    //       data: jQuery('form').serialize(),
    //       success: function(data) {
    //         console.log(data);
    //         $("#tngform").html(data);
    //         jQuery('#submit').click();
    //       }
    //     });
    //   })
    // });
  </script>




  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

</body>

</html>