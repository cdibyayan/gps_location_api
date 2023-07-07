<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
if ((isset($uri[3]) && $uri[3] != 'v1') || !isset($uri[4])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
 else {
    include_once "db.php";
    $data = json_decode(file_get_contents("php://input"), true);
    $uid = $data['uid'];
    $zone = $data['zone'];
    $location = $data['location'];
    $status = $data['status'];
    
    $sql="INSERT INTO `gps_data`(`uid`, `last_zone`, `last_loc`, `status`, `last_update`)
     VALUES ('$uid','$zone','$location','$status',now())";
     $result = mysqli_query($mysqli, $sql);

     if ($result) {
        echo json_encode(array("status"=>"success"));
     }else{
        echo json_encode(array("status"=>"error"));
     }
     
 }

?>