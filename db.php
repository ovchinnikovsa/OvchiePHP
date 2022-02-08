<?php

$dbname = 'simpleblogdb';
$username = 'root';
$password = '';
$hostname = 'localhost';

try{
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (PDOExcetion $e) {
    echo 'Невозможно установить соединение с базой данных';
}

session_start();
