<?php
require 'config.php';

if (empty($_SESSION['SUPER_ADMIN_USERNAME'])) {
    header("location:index");
}


error_reporting(0);
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = mysqli_real_escape_string($con, $_GET['type']);;
    if ($type == 'delete') {
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $delete_sql = "delete from admin_users where admin_id = '$id'";
        mysqli_query($con, $delete_sql);
        $_SESSION['status'] = 'SUCCESSFULLY DELETED';
    }
    else if  ($type == 'activate') {
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $sql = mysqli_query($con, "SELECT username from admin_users where admin_id = '$id'");
        $row = mysqli_fetch_assoc($sql);
        $user = $row['username'];
        shell_exec("sudo certbot --apache --domains ${user}.sui28.com --redirect");
        $update_sql = "UPDATE admin_users SET activate=1 where admin_id = '$id'";
        mysqli_query($con, $update_sql);
    }
}
if (!empty($_SESSION['status'])) {
    $status = '<div class="alert alert-primary" role="alert">
    ' . $_SESSION['status'] . '
  </div>';
    unset($_SESSION['status']);
}
?>

<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Merchant Master</title>

    <!-- head tag closed and body tag started in super_admin_header.php file  -->

    <?php include 'super_admin_header.php'; ?>

    <div class="content pb-0">
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <!-- <div class="card-header">
                            <strong>MERCHANT</strong><small> Master</small><br>
                            <h4 class="box-title" style="font-size: 12px !important;"><a href="add_merchant.php">Add Merchant</a></h4>
                        </div> -->

                        <div class="card-body">
                            <h4 class="box-title">Merchants</h4>
                            <!-- <h4 class="box-title" style="font-size: 12px !important;"><a href="add_merchant">Add Merchant</a></h4> -->
                            <h4 class="box-title" style="font-size: 12px !important;"><?php echo $status ?></h4>
                        </div>

                        <div class="card-body--">
                            <div class="table-stats order-table ov-h">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Link</th>
                                            <th>&nbsp;Edit</th>
                                            <th>Delete</th>
                                            <th>Activate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $sql = mysqli_query($con, "SELECT * FROM admin_users");
                                        while ($row = mysqli_fetch_assoc($sql)) { ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $row['username']; ?></td>
                                                <td><?php echo $row['password']; ?></td>
                                                <td><?php echo $row['link']; ?></td>
                                                <td>
                                                    <?php
                                                    echo "<span class='badge badge-edit'><a href='edit_merchant?&admin_id=" . $row['admin_id'] . "'>Edit</a></span>";
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo "<span class='badge badge-delete'><a href='?type=delete&id=" . $row['admin_id'] . "'>Delete</a></span>";
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($row['activate']==0) {
                                                        $show = 'Activate';
                                                    }
                                                    else
                                                    {
                                                        $show = 'Done';
                                                    }
                                                    echo "<span class='badge badge-delete'><a href='?type=activate&id=" . $row['admin_id'] . "'>$show</a></span>";
                                                    ?>
                                                </td>
                
                                            </tr>
                                        <?php $i++;
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



    <?php include 'super_admin_footer.php'; ?>

    </body>

</html>