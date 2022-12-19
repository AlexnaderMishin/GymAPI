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

if( isset ($h, $w, $indexMass)){
    
    $sql = "INSERT INTO user_info (`user_id`, `user_weight`, `user_height`, `ibm`) VALUES ('$userId','$w', '$h', '$indexMass')";
    $pdo->exec($sql);
    echo $h.'-'.$w.'-'.$indexMass.'-'.$_SESSION['userId'];
}

// echo $h.' '.$w.' '.$indexMass;
