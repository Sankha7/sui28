<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product Master</title>

    <!-- head tag closed and body tag started in super_admin_header.php file  -->


    <?php
    require 'header.php';
    error_reporting(0);
    $merchant_id = $_SESSION['MERCHANT_ID'];
    if (isset($_GET['type']) && $_GET['type'] != '') {
        $type = get_safe_value($con, $_GET['type']);
        if ($type == 'status') {
            $operation = get_safe_value($con, $_GET['operation']);
            $id = get_safe_value($con, $_GET['id']);
            if ($operation == 'active') {
                $status = '1';
            } else {
                $status = '0';
            }
            $update_status_sql = "update products set status='$status' where product_id = '$id'";
            mysqli_query($con, $update_status_sql);
        }
        if ($type == 'delivery') {
            $operation = get_safe_value($con, $_GET['operation']);
            $id = get_safe_value($con, $_GET['id']);
            if ($operation == 'active') {
                $delivery = '1';
            } else {
                $delivery = '0';
            }
            $update_status_sql = "update products set delivery='$delivery' where product_id = '$id'";
            mysqli_query($con, $update_status_sql);
        }


        if ($type == 'delete') {
            $id = get_safe_value($con, $_GET['id']);
            $delete_sql = "delete from products where product_id = '$id'";
            mysqli_query($con, $delete_sql);
            $_SESSION['status'] = 'SUCCESSFULLY DELETED';
        }
    }
    $sql = "select products.*, categories.category from categories, products where products.category_id=categories.category_id and categories.merchant_id='$merchant_id' order by product_id desc";
    $res = mysqli_query($con, $sql);

    if (!empty($_SESSION['status'])) {
        $status1 = '<div class="alert alert-primary" role="alert">
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
                            <h4 class="box-title">Products </h4>
                            <h4 class="box-title" style="font-size: 12px !important;"><a href="add_product">Add Product</a></h4>
                            <h4 class="box-title" style="font-size: 12px !important;"><?php echo $status1 ?></h4>
                        </div>

                        <div class="card-body--">
                            <div class="table-stats order-table ov-h">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>MRP</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Status</th>
                                            <th>Delivery</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $id = 1;
                                        while ($row = mysqli_fetch_assoc($res)) { ?>
                                            <tr>
                                                <td><?php echo $id ?></td>
                                                <td><?php echo $row['category'] ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><img src="media/products/<?php echo $row['image'] ?>" /></td>
                                                <td><?php echo $row['mrp'] ?></td>
                                                <td><?php echo $row['price'] ?></td>
                                                <td><?php echo $row['qty'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($row['status'] == 1) {
                                                        echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=" . $row['product_id'] . "'>Active</a></span>";
                                                    } else {
                                                        echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=" . $row['product_id'] . "'>Deactive</a></span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($row['delivery'] == 1) {
                                                        echo "<span class='badge badge-complete'><a href='?type=delivery&operation=deactive&id=" . $row['product_id'] . "'>Free</a></span>";
                                                    } else {
                                                        echo "<span class='badge badge-pending'><a href='?type=delivery&operation=active&id=" . $row['product_id'] . "'>Paid</a></span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo "<span class='badge badge-edit'><a href='add_product?&id=" . $row['product_id'] . "'>Edit</a></span>";
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo "<span class='badge badge-delete'><a href='?type=delete&id=" . $row['product_id'] . "'>Delete</a></span>";
                                                    ?>
                                                </td>
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
    require 'footer.php';
    ?>