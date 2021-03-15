<?php
session_start();
$con = mysqli_connect("localhost", "sui28", "Kolkata@123My", "ecom");
// $con = mysqli_connect("localhost", "root", "", "ecom");
if (empty($con)) {
    echo mysqli_connect_error($con);
}
