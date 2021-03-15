<?php
require 'config.php';
error_reporting(0);

if (empty($_SESSION['SUPER_ADMIN_USERNAME'])) {
    header("location:index");
}

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
    require 'super_admin_header.php';
    error_reporting(0);
    $sql = "select * from contact";
    $res = mysqli_query($con, $sql);
    ?>


    <div class="content pb-0">
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title">Contacts </h4>
                        </div>
                        <div class="card-body--">
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                        <tr>
                                            <th>ID</th>
                                            <th>Callback</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>DateTime</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $id = 1;
                                        while ($row = mysqli_fetch_assoc($res)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $id ?></td>
                                                <td><?php echo $row['callback'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><?php echo $row['message'] ?></td>
                                                <td><?php echo $row['datetime'] ?></td>
                                            </tr>
                                        <?php $id += 1;
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
    require 'super_admin_footer.php';
    ?>