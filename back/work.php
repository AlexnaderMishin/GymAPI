<?php
header('Content-Type: application/json; charset=utf-8');
include 'connect.php';



$data = $_POST["data"];
$data = json_decode($data, TRUE);

//заношу в переменные
$muscleGroup = $data["group"];
$exerciseArray = array();

$stmt = $pdo->query("SELECT * FROM `exercises` WHERE id_group = '$muscleGroup'");
while($row = $stmt->fetch()){
    $exerciseArray[] = $row;
}


if($exerciseArray !=['']){
    $response = [
        'exercise' => $exerciseArray,
        'message' => 'ok'
    ];

}else{
    $response = [
        'exercise' => $exerciseArray,
        'message' => 'error'
    ];
}
    



// var_dump($exerciseArray);
echo json_encode($response);   

?>