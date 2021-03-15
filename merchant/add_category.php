<?php
require 'header.php';

if (empty($_SESSION['MERCHANT_ID'])) {
    header("location:index");
}


$category = '';
$msg = '';
$merchant_id = $_SESSION['MERCHANT_ID'];
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from categories where category_id='$id' AND merchant_id = '$merchant_id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $category = $row['category'];
    } else {
        header('location:categories.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $category = get_safe_value($con, $_POST['category']);
    $res = mysqli_query($con, "select * from categories where category='$category' AND merchant_id = '$merchant_id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['category_id']) {
            } else {
                $msg = "Categories already exist";
            }
        } else {
            $msg = "Categories already exist";
        }
    }

    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            mysqli_query($con, "update categories set category='$category' where category_id='$id'");
        } else {
            mysqli_query($con, "insert into categories(merchant_id, category, status) values ('$merchant_id','$category', '1')");
        }
        header('location:categories.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Category</strong><small> Form</small></div>
                    <form method="post">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="category" class=" form-control-label">Category</label>
                                <input type="text" name="category" placeholder="Enter category name" class="form-control" required value="<?php echo $category ?>">
                            </div>
                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                            <div class="field_error"><?php echo $msg ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require 'footer.php';
?>