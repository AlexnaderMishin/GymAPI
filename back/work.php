<?php
include 'connect.php';
header('Content-Type: application/json; charset=utf-8');
session_start();

$data = $_POST["data"];
$data = json_decode($data, TRUE);

//заношу в переменные
$ex = $data["exercise"];
$we = $data["weight"];
$co = $data["count"];
$log = $_SESSION['userId'];
$date = date("Y.m.d");

$patternWeight = '/^[1-9]{1,3}$/';
$patternCount = '/^[1-9]{1,3}$/';



if( isset ($ex, $we, $co)){
    if(preg_match($patternWeight, $we) && preg_match($patternCount, $co)){
        $sql = "INSERT INTO `workout_stat`(`user_id`, `exercise_id`, `weight`, `count`, `date`)
        VALUES ('$log', '$ex', '$we', '$co', '$date')";
        $pdo->exec($sql);
        $response = [
            "message" => 'success',
        ]; 
    }else{
        $response = [
            "message" => 'error',
        ]; 
    }
    } 
echo json_encode($response);   

?>