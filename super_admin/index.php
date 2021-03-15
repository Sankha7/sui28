<?php
require 'config.php';
require 'functions.php';
$msg = "";
if (isset($_POST['submit'])) {
   $username = get_safe_value($con, $_POST['username']);
   $password = get_safe_value($con, $_POST['password']);
   $email =  get_safe_value($con, $_POST['email']);

   $sql = "select * from super_admin where username='$username' and email = '$email' and password='$password'";
   $res = mysqli_query($con, $sql);
   $count = mysqli_num_rows($res);
   if ($count > 0) {
      $_SESSION['SUPER_ADMIN_LOGIN'] = 'yes';
      $_SESSION['SUPER_ADMIN_USERNAME'] = $username;
      header('location: see_all_merchants');
      die();
   } else {
      $msg = "Please enter correct login details";
   }
}
?>




<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Login Page</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="assets/css/normalize.css">
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/font-awesome.min.css">
   <link rel="stylesheet" href="assets/css/themify-icons.css">
   <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
   <link rel="stylesheet" href="assets/css/flag-icon.min.css">
   <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
   <style>
      body {
         background-image: url('images/super_admin.png');
         background-position: center;
         background-size: cover;
         background-repeat: no-repeat;
      }
   </style>
</head>

<body>
   <div class="sufee-login d-flex align-content-center flex-wrap">
      <div class="container">

         <div class="login-content">
            <div class="text-center">
               <img src="../images/logo/logo.png" alt="" width="100px" height="100px">
               <!-- <h2 style="color:white; font-weight:bold;">SUPER ADMIN LOGIN</h2> -->
            </div>
            <div class="login-form mt-140">

               <form method="post">
                  <div class="col-auto">
                     <!-- <label for="">Username</label> -->
                     <div class="input-group">

                        <div class="input-group-prepend">
                           <div class="input-group-text"><i class="fas fa-user"></i></div>
                        </div>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                     </div>
                  </div><br>
                  <div class="col-auto">
                     <!-- <label for="">Email</label> -->
                     <div class="input-group">

                        <div class="input-group-prepend">
                           <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                     </div>
                  </div><br>
                  <div class="col-auto">
                     <!-- <label for="">Password</label> -->
                     <div class="input-group">

                        <div class="input-group-prepend">
                           <div class="input-group-text"><i class="fas fa-key"></i></div>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                     </div>
                  </div>
                  <br>
                  <button type="submit" name="submit" class="btn btn-primary btn-flat m-b-30 m-t-30 mb-2">Sign in</button>
               </form>
               <?php echo $msg ?>
            </div>
         </div>
      </div>
   </div>
   <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
   <script src="assets/js/popper.min.js" type="text/javascript"></script>
   <script src="assets/js/plugins.js" type="text/javascript"></script>
   <script src="assets/js/main.js" type="text/javascript"></script>
</body>

</html>