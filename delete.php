<?php 
include "db.php";
$id = $_GET['id'];
$sql = "DELETE FROM gps_data WHERE id='$id'";
$res = mysqli_query($mysqli, $sql);
header('location:dashboard.php');
?>