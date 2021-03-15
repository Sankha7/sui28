<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Category Form</title>

   <!-- head tag closed and body tag started in super_admin_header.php file  -->



<?php
require 'super_admin_header.php';
$status='';
$category='';
$msg='';
error_reporting(0);
$status = '';

if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from categories where category_id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$category=$row['category'];
	}else{
		header('location:categories');
		die();
	}
}

if(isset($_POST['submit'])){
	$category=get_safe_value($con,$_POST['category']);
	$res=mysqli_query($con,"select * from categories where category='$category'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Categories already exist";
			}
		}else{
			$msg="Categories already exist";
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$sql1 = mysqli_query($con,"update categories set category='$category' where category_id='$id'");
                if (!empty($sql1)) {
                    $_SESSION['status'] = 'SUCCESSFULLY UPDATED!';
                    }
		}else{
			$sql2 = mysqli_query($con,"insert into categories(category,status) values('$category','1')");
            if (!empty($sql2)) {
                $_SESSION['status'] = 'SUCCESSFULLY ADDED!';
                }
		}
		header('location:categories');
		// die();
	}
}

// if (isset($_POST['submit'])) {
//     $category = get_safe_value($con, $_POST['category']);
//     $sql = mysqli_query($con, "insert into categories(category, status) values ('$category', '1')");
//     if (!empty($sql)) {
//         $status = 'SUCCESSFULLY ADDED!';
//      }
//     header('location:categories.php');
//     die();
// }
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
                                <input type="text" name="category" placeholder="Enter category name" class="form-control" required value="<?php echo $category?>">
                            </div>
                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(!empty($status))
        {
            echo '<script>alert("'.$status.'")</script>';
        }
?>

<?php
require 'super_admin_footer.php';
?>