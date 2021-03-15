<?php
require 'connection.php';
if (empty($_SESSION['MERCHANT_ID'])) {
    header("location:index");
}

?>


<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Profile</title>

    <!-- head tag closed and body tag started in super_admin_header.php file  -->



    <?php
    require 'header.php';
    error_reporting(0);
    $id = $_SESSION['MERCHANT_ID'];
    $sql = mysqli_query($con, "SELECT * from admin_users WHERE admin_id= '$id'");
    $result = $sql->fetch_assoc();
    $name = $result['username'];
    $desc = $result['description'];
    $revret = $result['return_refund'];
    $policy = $result['policy'];
    $address = $result['address'];
    $contact = $result['contact'];
    $spublick = $result['spublick'];
    $sprivatek = $result['sprivatek'];
    $tngmid = $result['tngmid'];
    $tngsk = $result['tngsk'];
    ?>
    <?php
    if (isset($_POST['submit'])) {
        $admin_id = $_SESSION['MERCHANT_ID'];
        $desc = $_POST['desc'];
        $revret = $_POST['revret'];
        $policy = $_POST['policy'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $spublick = $_POST['spublick'];
        $sprivatek = $_POST['sprivatek'];
        $tngmid = $_POST['tngmid'];
        $tngsk = $_POST['tngsk'];

        //echo $admin_id;
        // print_r($_POST);


        $sql1 = mysqli_query($con, "update admin_users set description='$desc',return_refund='$revret',policy='$policy',address='$address',contact='$contact',spublick='$spublick',sprivatek='$sprivatek',tngmid='$tngmid',tngsk='$tngsk' where admin_id='$admin_id'");
        if (!empty($sql1)) {
            $_SESSION['status'] = 'SUCCESSFULLY UPDATED!';
        }
    }

    if (!empty($_SESSION['status'])) {
        $status = '<div class="alert alert-primary" role="alert">
        ' . $_SESSION['status'] . '
    </div>';
        unset($_SESSION['status']);
    }
    ?>

    <div class="content pb-0">
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title text-success">Edit Informations </h4>
                            <h4 class="box-title" style="font-size: 12px !important;"><?php echo $status ?></h4>
                        </div>
                        <div class="card card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label class="text-success" for="name">Merchant Name:</label>
                                    <input type="text" name="name" class="form-control col-sm-3" id="name" readonly value="<?php echo $name ?>">
                                </div>
                                <div class="form-group">
                                    <label class="text-success" for="desc">Description:</label>
                                    <textarea name="desc" id="desc" class="form-control"><?php echo $desc ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="text-success" for="desc">Return and Refund Information:</label>
                                    <textarea name="revret" id="revret" class="form-control"><?php echo $revret ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="text-success" for="desc">Policy:</label>
                                    <textarea name="policy" id="policy" class="form-control"><?php echo $policy ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="text-success" for="contact">Contact:</label>
                                    <input type="number" class="form-control" name="contact" id="contact" value="<?php echo $contact ?>">
                                </div>
                                <div class="form-group">
                                    <label class="text-success" for="desc">Address:</label>
                                    <textarea name="address" id="address" class="form-control"><?php echo $address ?></textarea>
                                </div>
                                <p>-------- FPX Payment Info -------</p>
                                <div class="form-group">
                                    <label class="text-success" for="desc">FPX Publishable Key:</label>
                                    <input type="text" class="form-control" name="spublick" id="spublick" value="<?php echo $spublick ?>">
                                </div>
                                <div class="form-group">
                                    <label class="text-success" for="desc">FPX Secret Key:</label>
                                    <input type="text" class="form-control" name="sprivatek" id="sprivatek" value="<?php echo $sprivatek ?>">
                                </div>
                                <p>-------- Touch N' Go Payment Info -------</p>
                                <div class="form-group">
                                    <label class="text-success" for="desc">Touch N' Go Merchant Id:</label>
                                    <input type="text" class="form-control" name="tngmid" id="tngmid" value="<?php echo $tngmid ?>">
                                </div>
                                <div class="form-group">
                                    <label class="text-success" for="desc">Touch N' Go Secret Key:</label>
                                    <input type="text" class="form-control" name="tngsk" id="tngsk" value="<?php echo $tngsk ?>">
                                </div>
                                <div class="form-group">
                                    <button id="submit" name="submit" class="btn btn-success btn-lg">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (!empty($status)) {
        echo '<script>alert("' . $status . '")</script>';
    }
    ?>

    <?php
    require 'footer.php';
    ?>