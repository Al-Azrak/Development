<?php
$dsn ='mysql://hostname=localhost;dbname=php_pdo' ;
$user='root';
$password="";
try
{
    $connection = new PDO($dsn, $user, $password, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ));
} catch(PDOException $e){
    echo "Error:" . $e->getMessage();
}