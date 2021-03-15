<?php
require 'header.php';

if (empty($_SESSION['MERCHANT_ID'])) {
    header("location:index");
}

$merchant_id = $_SESSION['MERCHANT_ID'];

$category_id = '';
$name = '';
$mrp = '';
$price = '';
$qty = '';
$image = '';
$short_desc = '';
$description = '';
$meta_title = '';
$meta_desc = '';
$meta_keyword = '';
$status = '';


$msg = '';
$image_required = 'required';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from products where product_id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $category_id = $row['category_id'];
        $name = $row['name'];
        $mrp = $row['mrp'];
        $price = $row['price'];
        $qty = $row['qty'];
        $short_desc = $row['short_desc'];
        $description = $row['description'];
        $meta_title = $row['meta_title'];
        $meta_desc = $row['meta_desc'];
        $meta_keyword = $row['meta_keyword'];
    } else {
        header('location:product.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $category_id = get_safe_value($con, $_POST['category_id']);
    $name = get_safe_value($con, $_POST['name']);
    $mrp = get_safe_value($con, $_POST['mrp']);
    $qty = get_safe_value($con, $_POST['qty']);
    $price = get_safe_value($con, $_POST['price']);
    $short_desc = get_safe_value($con, $_POST['short_desc']);
    $description = get_safe_value($con, $_POST['description']);
    $meta_title = get_safe_value($con, $_POST['meta_title']);
    $meta_desc = get_safe_value($con, $_POST['meta_desc']);
    $meta_keyword = get_safe_value($con, $_POST['meta_keyword']);

    $res = mysqli_query($con, "select * from products where name='$name'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['product_id']) {
            } else {
                $msg = "Product already exist";
            }
        } else {
            $msg = "Product already exist";
        }
    }

    if ($_GET['id'] == 0) {
        if ($_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg') {
            $msg = "please select only png, jpg and jpeg image format";
        }
    } else {
        if ($_FILES['image']['type'] != '') {
            if ($_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg') {
                $msg = "please select only png, jpg and jpeg image format";
            }
        }
    }

    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            if ($_FILES['image']['name'] != '') {
                $image = rand(11111111, 99999999) . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], 'media/products/' . $image);
                $update_sql = "update products set category_id='$category_id', name='$name', mrp='$mrp', price='$price', qty='$qty', short_desc='$short_desc', description='$description', meta_title='$meta_title', meta_desc='$meta_desc', meta_keyword='$meta_keyword', image='$image'  where product_id='$id'";
            } else {
                $update_sql = "update products set category_id='$category_id', name='$name', mrp='$mrp', price='$price', qty='$qty', short_desc='$short_desc', description='$description', meta_title='$meta_title', meta_desc='$meta_desc', meta_keyword='$meta_keyword'  where product_id='$id'";
            }
            $sql1 = mysqli_query($con, $update_sql);
            if (!empty($sql1)) {
                $_SESSION['status'] = 'SUCCESSFULLY UPDATED!';
            }
        } else {
            $image = rand(11111111, 99999999) . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], 'media/products/' . $image);
            $sql2 = mysqli_query($con, "insert into products(category_id, merchant_id, name, mrp, price, qty, short_desc, description, meta_title, meta_desc, meta_keyword, status, image) values ('$category_id', '$merchant_id','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1,'$image')");
            if (!empty($sql2)) {
                $_SESSION['status'] = 'SUCCESSFULLY ADDED!';
            }
        }
        header('location:product');
        // die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Product</strong><small> Form</small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="category" class=" form-control-label">Category</label>
                                <select class="form-control" name="category_id" id="">
                                    <option value="">Select Category</option>
                                    <?php
                                    $res = mysqli_query($con, "select category_id, category from categories where merchant_id = '$merchant_id' order by category asc");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        if ($row['category_id'] == $category_id) {
                                            echo "<option selected value=" . $row['category_id'] . ">" . $row['category'] . "</option>";
                                        } else {
                                            echo "<option value=" . $row['category_id'] . ">" . $row['category'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category" class=" form-control-label">Product Name</label>
                                <input type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name ?>">
                            </div>

                            <div class="form-group">
                                <label for="category" class=" form-control-label">MRP</label>
                                <input type="text" name="mrp" placeholder="Enter product mrp" class="form-control" required value="<?php echo $mrp ?>">
                            </div>

                            <div class="form-group">
                                <label for="category" class=" form-control-label">Price</label>
                                <input type="text" name="price" placeholder="Enter product price" class="form-control" required value="<?php echo $price ?>">
                            </div>

                            <div class="form-group">
                                <label for="category" class=" form-control-label">Quantity</label>
                                <input type="number" name="qty" placeholder="Enter Quantity" class="form-control" required value="<?php echo $qty ?>">
                            </div>

                            <div class="form-group">
                                <label for="category" class=" form-control-label">Image</label>
                                <input type="file" name="image" class="form-control" <?php echo $image_required ?>>
                            </div>

                            <div class="form-group">
                                <label for="category" class=" form-control-label">Short Description</label>
                                <br /><small style="color: red">Enter Full-Stop " . " to make a new line</small>
                                <textarea name="short_desc" placeholder="Enter product short description" class="form-control" maxlength="250" required><?php echo $short_desc ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="category" class=" form-control-label">Description</label>
                                <br /><small style="color: red">Enter Full-Stop " . " to make a new line</small>
                                <textarea name="description" placeholder="Enter product description" class="form-control" maxlength="255" required><?php echo $description ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="category" class=" form-control-label">Meta Title</label>
                                <textarea name="meta_title" placeholder="Enter product meta title" class="form-control"><?php echo $meta_title ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="category" class=" form-control-label">Meta Description</label>
                                <textarea name="meta_desc" placeholder="Enter product meta description" class="form-control"><?php echo $meta_desc ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="category" class=" form-control-label">Meta Keyword</label>
                                <textarea name="meta_keyword" placeholder="Enter product meta keyword" class="form-control"><?php echo $meta_keyword ?></textarea>
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
if (!empty($status)) {
    echo '<script>alert("' . $status . '")</script>';
}
?>

<?php
require 'footer.php';
?>