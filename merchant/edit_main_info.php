<?php
require 'connection.php';


if (empty($_SESSION['MERCHANT_ID'])) {
    header("location:index");
}



$status1 = '';
$merchant_id = $_SESSION['MERCHANT_ID'];
$sql = mysqli_query($con, "SELECT * from admin_users WHERE admin_id= '$merchant_id'");
$result = $sql->fetch_assoc();
$company_name = $result['company_name'];
$tagline = $result['tagline'];
$image = $result['logo'];

if (isset($_POST['submit'])) {
    $admin_id = $_SESSION['MERCHANT_ID'];
    $company_name = $_POST['name'];
    // $logo = $_POST['image'];
    $tagline = $_POST['tagline'];

    if ($_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg') {
        $msg = "please select only png, jpg and jpeg image format";
    }

    //echo $admin_id;
    // print_r($_POST);

    if ($msg == '') {

        if ($_FILES['image']['name'] != '') {
            $image = rand(11111111, 99999999) . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], 'media/logos/' . $image);
            $update_sql = mysqli_query($con, "update admin_users set company_name='$company_name',logo='$image',tagline='$tagline' where admin_id='$admin_id'");
            $_SESSION['status'] = 'SUCCESSFULLY UPDATED';
        }
    }


    if (!empty($update_sql)) {
        $_SESSION['statis'] = "SUCCESSFULLY UPDATED!";
        $status1 = '<div class="alert alert-primary" role="alert">
        ' . $_SESSION['status'] . '
    </div>';
        unset($_SESSION['status']);
    }
}
?>



<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Main Profile</title>

    <!-- head tag closed and body tag started in super_admin_header.php file  -->
    <?php
    require 'header.php'; ?>

    <div class="content pb-0">
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title text-success">Edit Main Informations </h4>
                            <h4 class="box-title" style="font-size: 12px !important;"><?php echo $status1 ?></h4>
                        </div>
                        <div class="card card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="text-success" for="name">Company Name:</label>
                                    <input type="text" name="name" class="form-control col-sm-3" id="company_name" value="<?php echo $company_name ?>">
                                </div>
                                <div class="form-group">
                                    <label for="category" class=" form-control-label">Logo</label>
                                    <input type="file" name="image" class="form-control col-sm-3">
                                </div>
                                <img src="media/logos/<?php echo $image ?>" height="100px" width="100px" />
                                <div class="form-group">
                                    <label class="text-success" for="desc">Tagline:</label>
                                    <input type="text" name="tagline" class="form-control col-sm-3" id="tagline" value="<?php echo $tagline ?>">
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

    <?php require "footer.php" ?>