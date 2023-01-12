<?php
session_start();
//подключение файла БД
include 'connect.php';
header('Content-Type: application/json; charset=utf-8');

// include '.htaccess';

//получение данных от ajax
$data = $_POST["data"];
$data = json_decode($data, TRUE);

//заношу в переменные
$log = $data["login"];
$pass = $data["password"];
$passConf = $data["passwordConf"];


//вывожу список пользотваелей для сравнения
$stmt = $pdo->query("SELECT * FROM `users` WHERE `username` = '$log'");
$row = $stmt->fetch();
$idUser = $row['id'];
//паттерн регулярного выражения для сравнения с логином
$pattern = '/^[a-zA-Z][a-zA-Z0-9]{5,12}$/';
$patternPass = '/^[a-zA-Z0-9]{8,15}$/';

//переменные ошибок

$LoginError = '';
$PassError = '';

//если пользователь не найден
if($log != $row['username']){
    //если логин соответствует требованиям
    if(preg_match($pattern, $log)){
        //если пароль соответствует требованиям
        if(preg_match($patternPass, $pass)){
            //если пароли равны
            if($pass == $passConf){
                $passmd5 = md5($pass);
                //знаосим данные в базу
                $sql = "INSERT INTO users (`username`, `password`) VALUES ('$log', '$passmd5')";
                $pdo->exec($sql);
                $_SESSION['userId'] = $idUser;
                $_SESSION['userLogin'] = $log;
                $response = [
                    "mess" => 'success',
                    "idUser" => $idUser,
                    "userLogin" => $log,
                    "stat" => true
                ];
                
                
            }else{
                $response = [
                    "message" => 'Пароли не совпадают',
                    "status" => false
                ];
              
            }
        }else{
            $response = [
                "message" => 'Пароль не соответствует требованиям',
                "status" => false
            ];
            echo "Пароль не соответствует требованиям";
        }
    }else{
        $response = [
            "message" => 'Логин не соответствует требованиям',
            "status" => false
        ];
       
    }
}else{
    $response = [
        "message" => 'Логин занят!',
        "status" => false
    ];

}
echo json_encode($response);

//проверка на наличие указанного логина
// if($log != $row['username']){
//     $AvailableLogin = true;
// }else{
//     $LoginError = 'Логин уже используется';
//     $AvailableLogin = false;
// }

// //проверка на соотвтествие правилам логина
// if(preg_match($pattern, $log)){
//     $loginCorrect = true;
// }else{
//     $LoginError = 'Логин не соответствует правилам';
//     // echo $LoginError;
// }

// //Проверка на соотвествие правилам пароля
// if(preg_match($patternPass, $pass)){
//     $passCorrect = true;
// }else{
//     $passCorrect = false;
//     $PassError = 'Пароль должен содежать минимум 8 символов - прописные и строчные буквы, а так же цифры.';
//     // echo $PassError;
// }
// if($pass == $passConf){
//     $passConfCor = true;
// }else{
//     $passConfCor = false;
//     $PassError = 'Пароли не совпадают!';
    
// }

//////////////////////////ВАЛИДАЦИЯ ПАРОЛЯ//////////////////////////////
//'(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$'///
//////////////////////////ВАЛИДАЦИЯ ЛОГИНА//////////////////////////////
////////////////////^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$////////////////////

