<?php

$host='localhost';
$db='TrainingAppDB';
$user='root';
$pass='';
$charset='utf8';

// $dsn="mysql:host=$host;dbname=$db;charset=$charset";
// $pdo=new PDO($dsn,$user,$pass);
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
    #MySQL с PDO_MYSQL
    $dsn="mysql:host=$host;dbname=$db;charset=$charset";
    $pdo=new PDO($dsn,$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
    echo $e->getMessage();
    }
?>