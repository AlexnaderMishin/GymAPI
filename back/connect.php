<?php

$host='localhost';
$db='alexat1m_gym';
$user='alexat1m_gym';
$pass='!tsdRimVq7196';
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