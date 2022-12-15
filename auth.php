<?php
include 'connect.php';
header('Content-Type: application/json; charset=utf-8');
session_start();

$data = $_POST["data"];
$data = json_decode($data, TRUE);

//заношу в переменные
$log = $data["login"];
$pass = md5($data["password"]);
$password = md5($pass);
$AuthStatus = false;

$stmt = $pdo->query("SELECT * FROM `users` WHERE `username` = '$log'");
$row = $stmt->fetch();


if($log == $row['username'] && $pass == $row["password"]){
    
    $_SESSION['userId'] = $row["id"];
    $_SESSION['userLogin'] = $row["username"];
    
    $response = [
        "id" => $_SESSION['userId'],
        "login" => $_SESSION['userLogin'],
        "status" => $AuthStatus = true
    ];
    // $response = $arr;
    // echo $_SESSION['userId'];

}else{
    echo "Пользователсь не существует!";
}
// if ($_SESSION['userId'])

// {

// echo '<script>var session_admin=1;</script>';

// }
echo json_encode($response);
header('index.php');
// var_dump($data);
?>