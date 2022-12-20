<?php
include 'connect.php';
header('Content-Type: application/json; charset=utf-8');
session_start();
$data = $_POST["data"];
$data = json_decode($data, TRUE);

//заношу в переменные
$h = $data["height"];
$w = $data["weight"];
$indexMass = $data["imb"];
$indexFat = $data["ifb"];
$userId = $_SESSION['userId'];
$log = $_SESSION['userId'];
$arrData  = [];
// echo $log;
$date = date("Y.m.d");
if( isset ($h, $w, $indexMass)){
    
    $sql = "INSERT INTO user_info (`user_id`, `user_weight`, `user_height`, `ibm`, `bfm`, `date`) VALUES ('$userId','$w', '$h', '$indexMass', '$indexFat', '$date ')";
    $pdo->exec($sql);
}
echo json_encode($response);    


// 
// echo $h.' '.$w.' '.$indexMass;
?>


