<?php
session_start();
include "db.php";
if($_POST['type']==2){
    $uid=$_POST['uid'];
    $password=$_POST['password'];
    $check=mysqli_query($mysqli,"select * from user where uid='$uid' and password='$password'");
    if (mysqli_num_rows($check)>0)
    {
        $_SESSION['uid']=$uid;
        echo json_encode(array("statusCode"=>200));
    }
    else{
        echo json_encode(array("statusCode"=>201));
    }
    mysqli_close($mysqli);
}