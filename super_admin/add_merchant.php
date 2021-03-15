<?php
require 'config.php';
error_reporting(0);

if (empty($_SESSION['SUPER_ADMIN_USERNAME'])) {
   header("location:index");
}


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
   $link = $_POST['link'];
   $sql1 = mysqli_query($con, "SELECT * FROM admin_users WHERE username='$username'");
   $rows = mysqli_num_rows($sql1);
   if ($rows > 0) {
      $_SESSION['status'] = 'ALREADY ADDED!';
      header("location:see_all_merchants");
   } else {
      $sql = mysqli_query($con, "INSERT INTO admin_users(username,password,link) VALUES('$username','$password','$link')");

      //USING SHELL SCRIPT
      // $path = "/var/www/sui28/shell_file.sh";
      // $shell_file = fopen($path, "w") or die("Unable to open file!");
      // $apache = '${APACHE_LOG_DIR}';
      // $content = "#!/bin/sh
      // sudo touch /etc/apache2/sites-available/${username}.sui28.conf
      //             echo '<VirtualHost *:80>
      //                    ServerAdmin webmaster@localhost
      //                    ServerName ${username}.sui28.com
      //                    ServerAlias www.${username}.sui28.com
      //                    DocumentRoot /var/www/${username}
      //                    ErrorLog ${apache}/error.log
      //                    CustomLog ${apache}/access.log combined
      //                </VirtualHost>' > /etc/apache2/sites-available/${username}.sui28.conf
      //                sudo mkdir /var/www/${username}
      //                cp /var/www/sui28/* /var/www/${username}
      //                cd /etc/apache2/sites-available/ && a2ensite ${username}.sui28.conf
      //                cd /etc/apache2/sites-available/ && systemctl reload apache2
      // ";
      // fwrite($shell_file, $content);
      // exec(dirname(__FILE__) . '/shell_file.sh');


      // USING PHP
      $path = "/etc/apache2/sites-available/${username}.sui28.conf";
      $myfile = fopen($path, "w") or die("Unable to open file!");

      $apache = '${APACHE_LOG_DIR}';

      $txt = "<VirtualHost *:80>
            ServerAdmin webmaster@localhost
            ServerName ${username}.sui28.com
            ServerAlias www.${username}.sui28.com
            DocumentRoot /var/www/${username}
            ErrorLog ${apache}/error.log
            CustomLog ${apache}/access.log combined
        </VirtualHost>";


      fwrite($myfile, $txt);

      // dont need this 
      // $destdir = 'css/';
      // file_put_contents($destdir, $myfile);

      //need to create another folder in var/www/html from where the user can access
      $folder_path = "/var/www/${username}";
      mkdir($folder_path, 0777);

      //Create a new index file.
      $path2 = $folder_path . '/' . 'index.php';
      $myfile = fopen($path2, "w") or die("Unable to open file!");
      //create a new checkout file.
      $path3 = $folder_path . '/' . 'checkout.php';
      $myfile = fopen($path3, "w") or die("Unable to open file!");
      //create another file
      $path3 = $folder_path . '/' . 'add_to_cart.php';
      $myfile = fopen($path3, "w") or die("Unable to open file!");
      //create another file
      $path3 = $folder_path . '/' . 'cat_fetch.php';
      $myfile = fopen($path3, "w") or die("Unable to open file!");
      //create another file
      $path3 = $folder_path . '/' . 'category_fetch.php';
      $myfile = fopen($path3, "w") or die("Unable to open file!");
      //create another file
      $path3 = $folder_path . '/' . 'connection.php';
      $myfile = fopen($path3, "w") or die("Unable to open file!");
      //create another file
      $path3 = $folder_path . '/' . 'fetch.php';
      $myfile = fopen($path3, "w") or die("Unable to open file!");
      //create another file
      $path3 = $folder_path . '/' . 'functions.php';
      $myfile = fopen($path3, "w") or die("Unable to open file!");
      //create another file
      $path3 = $folder_path . '/' . 'manage_cart.php';
      $myfile = fopen($path3, "w") or die("Unable to open file!");
      //create another file
      $path3 = $folder_path . '/' . '.htaccess';
      $myfile = fopen($path3, "w") or die("Unable to open file!");


      // Store the path of source file 
      $index_source = '/var/www/sui28/subdomain_contents/index.php';
      $checkout_source = '/var/www/sui28/subdomain_contents/checkout.php';
      $add_to_cart_source = '/var/www/sui28/subdomain_contents/add_to_cart.php';
      $cat_fetch_source = '/var/www/sui28/subdomain_contents/cat_fetch.php';
      $category_fetch_source = '/var/www/sui28/subdomain_contents/category_fetch.php';
      $connection_source = '/var/www/sui28/subdomain_contents/connection.php';
      $fetch_source = '/var/www/sui28/subdomain_contents/fetch.php';
      $functions_source = '/var/www/sui28/subdomain_contents/functions.php';
      $manage_cart_source = '/var/www/sui28/subdomain_contents/manage_cart.php';
      $htaccess_source = '/var/www/sui28/subdomain_contents/.htaccess';

      $source = array($index_source, $checkout_source, $add_to_cart_source, $cat_fetch_source, $category_fetch_source, $connection_source, $fetch_source, $functions_source, $manage_cart_source, $htaccess_source);

      // Store the path of destination file 
      $index_destination = "/var/www/${username}/index.php";
      $checkout_destination = "/var/www/{$username}/checkout.php";
      $add_to_cart_destination = "/var/www/${username}/add_to_cart.php";
      $cat_fetch_destination = "/var/www/${username}/cat_fetch.php";
      $category_fetch_destination = "/var/www/${username}/category_fetch.php";
      $connection_destination = "/var/www/${username}/connection.php";
      $fetch_destination = "/var/www/${username}/fetch.php";
      $functions_destination = "/var/www/${username}/functions.php";
      $manage_cart_destination = "/var/www/${username}/manage_cart.php";
      $htaccess_destination = "/var/www/${username}/.htaccess";

      $destination = array($index_destination, $checkout_destination, $add_to_cart_destination, $cat_fetch_destination, $category_fetch_destination, $connection_destination, $fetch_destination, $functions_destination, $manage_cart_destination, $htaccess_destination);

      for ($i = 0; $i < 10; $i++) {
         copy($source[$i], $destination[$i]);
      }

      $src = "/var/www/sui28/stripe_3d_with_fpx";
      $dest = "/var/www/${username}/stripe_3d_with_fpx";

      shell_exec("cp -r $src $dest");

      $src = "/var/www/sui28/touch_and_go";
      $dest = "/var/www/${username}/touch_and_go";

      shell_exec("cp -r $src $dest");

      // if (!copy($index_source, $index_destination)) {
      //    echo "File can't be copied! \n";
      // } else {
      //    echo "File has been copied! \n";
      // }
      // if (!copy($checkout_source, $checkout_destination)) {
      //    echo "File can't be copied! \n";
      // } else {
      //    echo "File has been copied! \n";
      // }


      // a2ensite company2.example.conf 

      shell_exec("sudo a2ensite ${username}.sui28.conf");
      //sudo service apache2 restart OR systemctl reload apache2

      shell_exec("sudo systemctl reload apache2");
      // Need to run these two commands from /etc/apache2/sites-available 


      if (!empty($sql)) {
         $_SESSION['status'] = 'SUCCESSFULLY ADDED!';
         header("location:see_all_merchants");
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
   <title>Add Merchant</title>

   <!-- head tag closed and body tag started in super_admin_header.php file  -->

   <?php include 'super_admin_header.php'; ?>

   <div class="content pb-0">
      <div class="animated fadeIn">
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-header"><strong>ADD MERCHANT</strong></div>
                  <div class="card-body card-block">
                     <form method="post">
                        <input type="hidden" name="admin_id" value="<?php echo $admin_id ?>">
                        <div class="form-group"><label for="username" class=" form-control-label">Username</label>
                           <input type="text" id="username" name="username" onchange="generateLink(this.value)" placeholder="Enter username" class="form-control" value="<?php echo $username; ?>" required>
                        </div>
                        <div class="form-group"><label for="password" class=" form-control-label">Password</label>
                           <input type="text" id="password" name="password" placeholder="Enter Password" class="form-control" value="<?php echo $password; ?>" required>
                        </div>
                        <div class="form-group"><label for="link" class=" form-control-label">Link</label>
                           <input type="text" id="link" name="link" placeholder="Generated link" readonly class="form-control" value="" required>
                        </div>
                        <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block <?php echo $addclass ?>">
                           <span id="payment-button-amount">ADD</span>
                        </button>
                        <!-- <button id="payment-button" type="submit" name="update" class="btn btn-lg btn-info btn-block <?php echo $updateButton ?>">
                           <span id="payment-button-amount">UPDATE</span>
                        </button> -->
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="clearfix"></div>

   <?php include 'super_admin_footer.php'; ?>
   <script>
      function generateLink(uname) {
         document.getElementById("link").value = 'https://' + uname + '.sui28.com';
      }
   </script>
   </body>

</html>