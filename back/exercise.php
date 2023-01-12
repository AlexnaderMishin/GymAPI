<?php
include 'connect.php';
header('Content-Type: application/json; charset=utf-8');
$data = $_POST["data"];
$data = json_decode($data, TRUE);

$ex = $data["exercise"];
$de = $data["description"];
$gr = $data["group"];

