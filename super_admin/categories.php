<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Categories Master</title>

    <!-- head tag closed and body tag started in super_admin_header.php file  -->



<?php
require 'super_admin_header.php';
error_reporting(0);
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
        $update_status_sql = "update categories set status='$status' where category_id = '$id'";
        mysqli_query($con, $update_status_sql);
    }

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from categories where category_id = '$id'";
        mysqli_query($con, $delete_sql);
        $_SESSION['status']='SUCCESSFULLY DELETED';
    }
}
$sql = "select * from categories order by category asc";
$res = mysqli_query($con, $sql);


if(!empty($_SESSION['status']))
{
    $status1 = '<div class="alert alert-primary" role="alert">
    '.$_SESSION['status'].'
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
                        <h4 class="box-title">Categories </h4>
                        <h4 class="box-title" style="font-size: 12px !important;"><a href="add_category">Add Category</a></h4>
                        <h4 class="box-title" style="font-size: 12px !important;"><?php echo $status1 ?></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Categories</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id=1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $row['category'] ?></td>
                                            <td>
                                                <?php
                                                if ($row['status'] == 1) {
                                                    echo "<a href='?type=status&operation=deactive&id=" . $row['category_id'] . "'>Active</a>";
                                                } else {
                                                    echo "<a href='?type=status&operation=active&id=" . $row['category_id'] . "'>Deactive</a>";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo "<a href='add_category?id=" . $row['category_id'] . "'>Edit</a>";
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo "<a href='?type=delete&id=" . $row['category_id'] . "'>Delete</a>";
                                                ?>
                                            </td>
                                        </tr>
                                    <?php $id+=1; } ?>
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