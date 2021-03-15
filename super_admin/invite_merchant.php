<?php
require 'config.php';

if (empty($_SESSION['SUPER_ADMIN_USERNAME'])) {
    header("location:index");
}

$status = '';
error_reporting(0);
if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $link = $_POST['link'];
    $content = $_POST['content'];
    $email1 = $_POST['email'];
    $mark = explode(',', $email1);

    $email = "info@dotlinkertech.com";
    foreach ($mark as $out) {
        $address = $out;

        $e_subject = 'Join To Sui28 and Bring your business online.';
        $data = '<!DOCTYPE html>
      <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
      <head>
          <meta charset="utf-8"> <!-- utf-8 works for most cases -->
          <meta name="viewport" content="width=device-width">
          <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
          <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
          <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->
      
          <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
      
          <!-- CSS Reset : BEGIN -->
          <style>
      
              /* What it does: Remove spaces around the email design added by some email clients. */
              /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
              html,
      body {
          margin: 0 auto !important;
          padding: 0 !important;
          height: 100% !important;
          width: 100% !important;
          background: #f1f1f1;
      }
      
      /* What it does: Stops email clients resizing small text. */
      * {
          -ms-text-size-adjust: 100%;
          -webkit-text-size-adjust: 100%;
      }
      
      /* What it does: Centers email on Android 4.4 */
      div[style*="margin: 16px 0"] {
          margin: 0 !important;
      }
      
      /* What it does: Stops Outlook from adding extra spacing to tables. */
      table,
      td {
          mso-table-lspace: 0pt !important;
          mso-table-rspace: 0pt !important;
      }
      
      /* What it does: Fixes webkit padding issue. */
      table {
          border-spacing: 0 !important;
          border-collapse: collapse !important;
          table-layout: fixed !important;
          margin: 0 auto !important;
      }
      
      /* What it does: Uses a better rendering method when resizing images in IE. */
      img {
          -ms-interpolation-mode:bicubic;
      }
      
      /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
      a {
          text-decoration: none;
      }
      
      /* What it does: A work-around for email clients meddling in triggered links. */
      *[x-apple-data-detectors],  /* iOS */
      .unstyle-auto-detected-links *,
      .aBn {
          border-bottom: 0 !important;
          cursor: default !important;
          color: inherit !important;
          text-decoration: none !important;
          font-size: inherit !important;
          font-family: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
      }
      
      /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
      .a6S {
          display: none !important;
          opacity: 0.01 !important;
      }
      
      /* What it does: Prevents Gmail from changing the text color in conversation threads. */
      .im {
          color: inherit !important;
      }
      
      img.g-img + div {
          display: none !important;
      }
      
     
      
      /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
      @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
          u ~ div .email-container {
              min-width: 320px !important;
          }
      }
      /* iPhone 6, 6S, 7, 8, and X */
      @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
          u ~ div .email-container {
              min-width: 375px !important;
          }
      }
      /* iPhone 6+, 7+, and 8+ */
      @media only screen and (min-device-width: 414px) {
          u ~ div .email-container {
              min-width: 414px !important;
          }
      }
      
      
          </style>
      
          <!-- CSS Reset : END -->
      
          <!-- Progressive Enhancements : BEGIN -->
          <style>
      
              .primary{
          background: #17bebb;
      }
      .bg_white{
          background: #ffffff;
      }
      .bg_light{
          background: #f7fafa;
      }
      .bg_black{
          background: #000000;
      }
      .bg_dark{
          background: rgba(0,0,0,.8);
      }
      .email-section{
          padding:2.5em;
      }
      
      /*BUTTON*/
      .btn{
          padding: 10px 15px;
          display: inline-block;
      }
      .btn.btn-primary{
          border-radius: 5px;
          background: #800080;
          color: #ffffff;
      }
      .btn.btn-white{
          border-radius: 5px;
          background: #ffffff;
          color: #000000;
      }
      .btn.btn-white-outline{
          border-radius: 5px;
          background: transparent;
          border: 1px solid #fff;
          color: #fff;
      }
      .btn.btn-black-outline{
          border-radius: 0px;
          background: transparent;
          border: 2px solid #000;
          color: #000;
          font-weight: 700;
      }
      .btn-custom{
          color: rgba(0,0,0,.3);
          text-decoration: underline;
      }
      
      h1,h2,h3,h4,h5,h6{
          font-family: Poppins, sans-serif;
          color: #000000;
          margin-top: 0;
          font-weight: 400;
      }
      
      body{
          font-family: Poppins, sans-serif;
          font-weight: 400;
          font-size: 15px;
          line-height: 1.8;
          color: rgba(0,0,0,.4);
      }
      
      a{
          color: #17bebb;
      }
      
      table{
      }
      /*LOGO*/
      
      .logo h1{
          margin: 0;
      }
      .logo h1 a{
          color: #17bebb;
          font-size: 24px;
          font-weight: 700;
          font-family: Poppins, sans-serif;
      }
      
      /*HERO*/
      .hero{
          position: relative;
          z-index: 0;
      }
      
      .hero .text{
          color: rgba(0,0,0,.3);
      }
      .hero .text h2{
          color: #000;
          font-size: 34px;
          margin-bottom: 0;
          font-weight: 200;
          line-height: 1.4;
      }
      .hero .text h3{
          font-size: 24px;
          font-weight: 300;
      }
      .hero .text h2 span{
          font-weight: 600;
          color: #000;
      }
      
      .text-author{
          bordeR: 1px solid rgba(0,0,0,.05);
          max-width: 50%;
          margin: 0 auto;
          padding: 2em;
      }
      .text-author img{
          border-radius: 50%;
          padding-bottom: 20px;
      }
      .text-author h3{
          margin-bottom: 0;
      }
      ul.social{
          padding: 0;
      }
      ul.social li{
          display: inline-block;
          margin-right: 10px;
      }
      
      /*FOOTER*/
      
      .footer{
          border-top: 1px solid rgba(0,0,0,.05);
          color: rgba(0,0,0,.5);
      }
      .footer .heading{
          color: #000;
          font-size: 20px;
      }
      .footer ul{
          margin: 0;
          padding: 0;
      }
      .footer ul li{
          list-style: none;
          margin-bottom: 10px;
      }
      .footer ul li a{
          color: rgba(0,0,0,1);
      }
      
      
      @media screen and (max-width: 500px) {
      
      
      }
      
      
          </style>
      
      
      </head>
      
      <body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
          <center style="width: 100%; background-color: #f1f1f1;">
          <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
          </div>
          <div style="max-width: 600px; margin: 0 auto;" class="email-container">
              <!-- BEGIN BODY -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tr>
                <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="logo" style="text-align: center;">
                              <h1><a href="#"><img src="../img/logo.png" alt="" height="100px" width="100px"></a></h1>
                            </td>
                        </tr>
                    </table>
                </td>
                </tr><!-- end tr -->
                      <tr>
                <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                          <td style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
                              <div class="text">
                                  <h2>Join Us, Bring your business Online</h2>
                              </div>
                          </td>
                      </tr>
                      <tr>
                            <td style="text-align: center;">
                                <div class="text-author">
                                    <img src="images/person_2.jpg" alt="" style="width: 100px; max-width: 600px; height: auto; margin: auto; display: block;">
                                    <h3 class="name">Hi,</h3>
                                    <h2>Username - ' . $username . '</h2>
                                    <h2>Password - ' . $password . '</h2>
                                    <h2>Link - ' . $link . '</h2>
                                    <span class="position">' . $content . '</span>
                                     <p><a href="https://sui28.com/merchant/login" class="btn btn-primary">Log in</a></p>
                                 </div>
                            </td>
                          </tr>
                  </table>
                </td>
                </tr><!-- end tr -->
            <!-- 1 Column Text + Button : END -->
            </table>
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tr>
                <td valign="middle" class="bg_light footer email-section">
                  <table>
                      <tr>
                      <td valign="top" width="33.333%" style="padding-top: 20px;">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                          <tr>
                            <td style="text-align: left; padding-right: 10px;">
                                <h3 class="heading">About</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td valign="top" width="33.333%" style="padding-top: 20px;">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                          <tr>
                            <td style="text-align: left; padding-left: 5px; padding-right: 5px;">
                                <h3 class="heading">Contact Info</h3>
                                <ul>
                                          <li><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                                          <li><span class="text">+2 392 3929 210</span></a></li>
                                        </ul>
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td valign="top" width="33.333%" style="padding-top: 20px;">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                          <tr>
                            <td style="text-align: left; padding-left: 10px;">
                                <h3 class="heading">Useful Links</h3>
                                <ul>
                                          <li><a href="#">Home</a></li>
                                          <li><a href="#">About</a></li>
                                          <li><a href="#">Services</a></li>
                                          <li><a href="#">Work</a></li>
                                        </ul>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr><!-- end: tr -->
              <tr>
                <td class="bg_light" style="text-align: center;">
                    <!-- <p>No longer want to receive these email? You can <a href="#" style="color: rgba(0,0,0,.8);">Unsubscribe here</a></p> -->
                </td>
              </tr>
            </table>
      
          </div>
        </center>
      </body>
      </html>';


        // Configuration option.
        // You can change this if you feel that you need to.
        // Developers, you may wish to add more fields to the form, in which case you must be sure to add them here.

        $e_body = "You have been contacted by $name with regards, their additional message is as follows." . PHP_EOL;
        $e_content = "\"$data\"" . PHP_EOL;
        $e_reply = "You can contact $name via email, $email ";

        $msg = wordwrap($e_body . $e_content . $e_reply, 70);

        $headers = "From: $email" . PHP_EOL;
        $headers .= "Reply-To: $email" . PHP_EOL;
        $headers .= "MIME-Version: 1.0" . PHP_EOL;
        $headers .= "Content-type: text/html; charset=utf-8" . PHP_EOL;
        //$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

        //mail($address, $e_subject, $msg, $headers);


        // Send email
        if (mail($address, $e_subject, $msg, $headers)) {
            $status = 1;
            //header('location:contact.php');  
        } else {
            $status = 0;
            //echo 'Email sending failed.';
        }
    }
}
$q = mysqli_query($con, 'SELECT * FROM admin_users');
?>

<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invite Merchant |</title>

    <!-- head tag closed and body tag started in super_admin_header.php file  -->

    <?php include 'super_admin_header.php'; ?>

    <div class="content pb-0">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><strong>MERCHANT</strong><small> INVITE</small></div>
                        <div class="card-body card-block">
                            <form method="post">
                                <div class="form-group"><label for="email" class=" form-control-label">Enter Emails</label>
                                    <input type="text" id="email" name="email" placeholder="Enter emails separated by (,) like a@xyz.com,b@xyz.com" class="form-control" required>
                                </div>

                                <div class="form-group"><label for="merchantName">Merchant Name</label>
                                    <select name="merchantName" class="form-control" id="merchantName">
                                        <option value="">Select a merchant</option>
                                        <?php $merchantData = array();
                                        $c = 0;
                                        while ($row = mysqli_fetch_assoc($q)) {
                                            $merchantData[$c] = $row;
                                            $c++;
                                            echo '<option value="' . $row['username'] . '">' . $row['username'] . '</option>';
                                        } ?>
                                    </select>
                                </div>
                                <?php foreach ($merchantData as $row) {
                                    echo '<div class="form-group row" data-parent="' . $row['username'] . '" style="display: none;">
                                        <div class="col-6">
                                            <label for="merchantName">Merchant Name</label>
                                            <input type="text" readonly name="username" class="form-control" value="' . $row['username'] . '">
                                        </div>
                                        <div class="col-6">
                                            <label for="merchantName">Merchant Password</label>
                                            <input type="text" readonly name="password" class="form-control" value="' . $row['password'] . '">
                                        </div>
                                        <div class="col-12">
                                            <label for="merchantName">Merchant Link</label>
                                            <input type="text" readonly name="link" class="form-control" value="' . $row['link'] . '">
                                        </div>
                                    </div>';
                                } ?>

                                <div class="form-group"><label for="content" class=" form-control-label">Content</label>
                                    <input type="text" id="content" name="content" placeholder="Enter content" class="form-control" required>
                                </div>
                                <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">SEND</span>
                                </button>
                            </form><br>
                            <?php if ($status == 1) {
                                echo '<div class="alert alert-primary" role="alert">
                                Email Sent
                                </div>';
                            }
                            // else if ($status == 0) echo '<div class="alert alert-primary" role="alert">
                            // Email not Sent
                            // </div>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <?php include 'super_admin_footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
        $(function() {
            $("#merchantName").on("change", function() {
                console.log($(this).val())
                if ($(this).val() !== "") {
                    $("div[data-parent='" + $(this).val() + "']").show().siblings("[data-parent]").hide();

                } else {
                    $("[data-parent]").hide();
                }
            });
        });
    </script>
    </body>

</html>