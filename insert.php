<?php 
session_start();
include_once "db.php";
$uid = $_POST['uid'];
$name=$_POST['name'];
$zone = $_POST['zone'];
$location = $_POST['location'];
$status = $_POST['status'];

$sql="INSERT INTO `gps_data`(`uid`, `name`, `last_zone`, `last_loc`, `status`, `last_update`)
 VALUES ('$uid','$name','$zone','$location','$status',now())";
 $result = mysqli_query($mysqli, $sql);

if ($result) {
    $_SESSION['msg']="Inserted Successfully";
    header('location:dashboard.php');
}else{
    $_SESSION['msg']="Something Went Wrong";
    header('location:dashboard.php');
}
?>