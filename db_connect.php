<?php
$host = 'ec2-54-243-213-188.compute-1.amazonaws.com';
$port = '5432';
$db   = 'dfip05gaio33q9';
$user = 'yqghebejkgtyuk';
$pass = 'e4ec888ff29da9d31eeb4111990c441462a95d4087f8cb6230151767a51712b2';
$sgbd='pgsql';      // pgsql, mysql
//$table='customers';
$ssl='require';



$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
];

try {    $pdo = new PDO("$sgbd:host=$host;port=$port;dbname=$db;sslmode=$ssl;", $user, $pass, $opt);


}catch(PDOException $e){
    echo '<br><br><b>Mensaje</b>: '. $e->getMessage().'<br>';
    echo '<b>File</b>: '.$e->getFile().'<br>';
    echo '<b>Line</b>: '.$e->getLine().'<br>';
}

