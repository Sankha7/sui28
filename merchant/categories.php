<?php
require 'header.php';

if (empty($_SESSION['MERCHANT_ID'])) {
    header("location:index");
}


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
        $update_status_sql = "update categories set status='$status' where category_id = '$id'";
        mysqli_query($con, $update_status_sql);
    }

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from categories where category_id = '$id'";
        mysqli_query($con, $delete_sql);
    }
}
$sql = "select * from categories where merchant_id='$merchant_id' order by category asc";
$res = mysqli_query($con, $sql);
?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Categories </h4>
                        <h4 class="box-title" style="font-size: 12px !important;"><a href="add_category.php">Add Category</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Categories</th>
                                        <th>&nbsp;Status</th>
                                        <th>&nbsp;Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr>
                                            <td><?php echo $row['category_id'] ?></td>
                                            <td><?php echo $row['category'] ?></td>
                                            <td>
                                                <?php
                                                if ($row['status'] == 1) {
                                                    echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=" . $row['category_id'] . "'>Active</a></span>";
                                                } else {
                                                    echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=" . $row['category_id'] . "'>Deactive</a></span>";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo "<span class='badge badge-edit'><a href='add_category.php?&id=" . $row['category_id'] . "'>Edit</a></span>";
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo "<span class='badge badge-delete'><a href='?type=delete&id=" . $row['category_id'] . "'>Delete</a></span>";
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
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