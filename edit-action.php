<?php 
session_start();
include_once "db.php";
$id = $_POST['id'];
$uid = $_POST['uid'];
$name=$_POST['name'];
$zone = $_POST['zone'];
$location = $_POST['location'];
$status = $_POST['status'];

$sql="UPDATE `gps_data` SET `uid`='$uid', `name`='$name', `last_zone`='$zone',`last_loc`='$location',`status`='$status',`last_update`=now() WHERE `id`='$id'";
 $result = mysqli_query($mysqli, $sql);

if ($result) {
    $_SESSION['msg']="Inserted Successfully";
    header('location:dashboard.php');
}else{
    $_SESSION['msg']="Something Went Wrong";
    header('location:dashboard.php');
}
?>