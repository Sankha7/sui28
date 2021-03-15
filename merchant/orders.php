<?php
require 'connection.php';

if (empty($_SESSION['MERCHANT_ID'])) {
   header("location:index");
}
error_reporting(0);

?>

<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Order Master</title>

   <!-- head tag closed and body tag started in super_admin_header.php file  -->
   <style>
      td {
         font-size: 12px !important;
      }
   </style>




   <?php
   require 'header.php';
   error_reporting(0);
   $merchant_id = $_SESSION['MERCHANT_ID'];

   $name = '';
   $sql = "select * from orders where merchant_id=$merchant_id";
   $res = mysqli_query($con, $sql);
   ?>



   <div class="content pb-0">
      <div class="orders">
         <div class="row">
            <div class="col-xl-12">
               <div class="card">
                  <div class="card-body">
                     <h4 class="box-title">Orders </h4>
                  </div>

                  <div class="card-body--">
                     <div class="table-stats order-table ov-h">

                        <table class="table">
                           <thead>
                              <tr>
                                 <th>ID</th>
                                 <th>Name</th>
                                 <th>Address</th>
                                 <th>Postal</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <th>Notes</th>
                                 <th>Products</th>
                                 <th>Total</th>
                                 <th>Payment status</th>
                                 <th>Payment method</th>
                                 <th>Transaction ID</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $id = 1;
                              while ($row = mysqli_fetch_assoc($res)) {
                                 $pid = explode(',', $row['product_id']);
                                 foreach ($pid as $key) {
                                    // echo $key;
                                    $sql = mysqli_query($con, "select name from products where product_id=$key");
                                    $res1 = mysqli_fetch_assoc($sql);
                                    $name .= $res1['name'] . ',';
                                 }
                              ?>
                                 <tr>
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $row['customer_name'] ?></td>
                                    <td><?php echo $row['customer_address'] ?></td>
                                    <td><?php echo $row['customer_postal'] ?></td>
                                    <td><?php echo $row['customer_phone'] ?></td>
                                    <td><?php echo $row['customer_email'] ?></td>
                                    <td><?php echo $row['order_notes'] ?></td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $row['total'] ?></td>
                                    <td><?php echo $row['payment_status'] ?></td>
                                    <td><?php echo $row['payment_method'] ?></td>
                                    <td><?php echo $row['txn_id'] ?></td>

                                 </tr>
                              <?php $id += 1;
                              $name='';
                              } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <?php
   require 'footer.php';
   ?>