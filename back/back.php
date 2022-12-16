<?php
include 'connect.php';
header('Content-Type: application/json; charset=utf-8');

$data = $_POST["data"];
$data = json_decode($data, TRUE);

//заношу в переменные
$h = $data["height"];
$w = $data["weight"];
$indexMass = $data["imb"];
$indexFat = $data["ifb"];

echo $h.' '.$w.' '.$indexMass;
