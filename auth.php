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


if($log == $row['username']){
    if($pass == $row["password"]){
        $_SESSION['userId'] = $row["id"];
        $_SESSION['userLogin'] = $row["username"];
        $response = [
            "message" => 'success',
            "id" => $_SESSION['userId'],
            "login" => $_SESSION['userLogin'],
            "status" => true
        ]; 
    }else{
        $response = [
            "message" => 'success',
            "id" => '',
            "login" => 'Неверный пароль!',
            "status" => false
        ];
    }
}else{
    $response = [
        "message" => 'success',
        "id" => '',
        "login" => 'Пользователь не найден!',
        "status" => false
    ];
}

// if($log == $row['username'] && $pass == $row["password"]){
    
//     $_SESSION['userId'] = $row["id"];
//     $_SESSION['userLogin'] = $row["username"];
    
//     $response = [
//         "message" => 'success',
//         "id" => $_SESSION['userId'],
//         "login" => $_SESSION['userLogin'],
//         "status" => 'true'
//     ];
//     // $response = $arr;
//     // echo $_SESSION['userId'];

// }else{
//     $response = [
//         "message" => 'success',
//         "id" => '',
//         "login" => 'неверный логин или пароль',
//         "status" => false
//     ];
//     // echo "Пользователсь не существует!";
// }
// if ($_SESSION['userId'])

// {

// echo '<script>var session_admin=1;</script>';

// }
echo json_encode($response);
// header('index.php');
// var_dump($data);
?>