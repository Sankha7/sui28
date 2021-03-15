<?php
require 'config.php';

if (empty($_SESSION['SUPER_ADMIN_USERNAME'])) {
   header("location:index");
}


error_reporting(0);
$status = '';
$username = '';
$password = '';
$admin_id = '';

if (isset($_GET['admin_id']) && $_GET['admin_id'] != '') {
   $admin_id = mysqli_real_escape_string($con, $_GET['admin_id']);
   $sql = mysqli_query($con, "SELECT * FROM admin_users WHERE admin_id='$admin_id'");
   $res = mysqli_fetch_assoc($sql);
   $username = $res['username'];
   $password = $res['password'];
   $addclass = 'disabled';
} else {
   $updateButton = 'disabled';
}

if (isset($_POST['update']) && $_POST['admin_id'] != '') {
   $username = mysqli_real_escape_string($con, $_POST['username']);
   $admin_id = mysqli_real_escape_string($con, $_POST['admin_id']);
   $password = $_POST['password'];
   $sql1 = mysqli_query($con, "UPDATE admin_users SET username='$username',password='$password' WHERE admin_id='$admin_id'");
   if (!empty($sql1)) {
      $_SESSION['status'] = 'SUCCESSFULLY UPDATED!';
      header("location:see_all_merchants");
   }
}


if (isset($_POST['submit']) && $_POST['admin_id'] == '') {
   $username = mysqli_real_escape_string($con, $_POST['username']);
   $password = $_POST['password'];
   $sql1 = mysqli_query($con, "SELECT * FROM admin_users WHERE username='$username'");
   $rows = mysqli_num_rows($sql1);
   if ($rows > 0) {
      $status = 'ALREADY ADDED!';
   } else {
      $sql = mysqli_query($con, "INSERT INTO admin_users(username,password) VALUES('$username','$password')");
      if (!empty($sql)) {
         $status = 'SUCCESSFULLY ADDED!';
      }
   }
} else {
}

?>

<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Edit Merchant</title>

   <!-- head tag closed and body tag started in super_admin_header.php file  -->

   <?php include 'super_admin_header.php'; ?>

   <div class="content pb-0">
      <div class="animated fadeIn">
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-header"><strong>MERCHANT</strong><small> EDIT</small></div>
                  <div class="card-body card-block">
                     <form method="post">
                        <input type="hidden" name="admin_id" value="<?php echo $admin_id ?>">
                        <div class="form-group"><label for="username" class=" form-control-label">Username</label>
                           <input type="text" id="username" name="username" placeholder="Enter username" class="form-control" value="<?php echo $username; ?>" required>
                        </div>
                        <div class="form-group"><label for="password" class=" form-control-label">Password</label>
                           <input type="text" id="password" name="password" placeholder="Enter Password" class="form-control" value="<?php echo $password; ?>" required>
                        </div>
                        <!-- <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block <?php echo $addclass ?>">
                           <span id="payment-button-amount">ADD</span>
                        </button> -->
                        <button id="payment-button" type="submit" name="update" class="btn btn-lg btn-info btn-block <?php echo $updateButton ?>">
                           <span id="payment-button-amount">UPDATE</span>
                        </button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="clearfix"></div>

   <?php include 'super_admin_footer.php'; ?>

   </body>

</html>