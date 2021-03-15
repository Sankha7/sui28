<?php
require 'config.php';
error_reporting(0);
?>

<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Master</title>

    <!-- head tag closed and body tag started in super_admin_header.php file  -->

    <?php include 'super_admin_header.php'; ?>

    <div class="content pb-0">
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Users </h4>
                    </div>
                        <div class="card-body--">
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>&nbsp;Mobile</th>
                                            <th>Joined On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $sql = mysqli_query($con, "SELECT * FROM users");
                                        while ($row = mysqli_fetch_assoc($sql)) { ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td>
                                                    <?php
                                                    echo $row['mobile'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $row['added_on'];
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