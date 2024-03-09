<?php

error_reporting(0);

$ini_file = parse_ini_file(__DIR__ . '/db.ini');

$db_host = $ini_file['DB_HOST'];
$db_name = $ini_file['MARIADB_DATABASE'];
$db_user = $ini_file['MARIADB_USER'];
$db_pass = $ini_file['MARIADB_PASSWORD'];
$db_dns = 'mysql:host=' . $db_host . ';dbname=' . $db_name;

try {
    $pdo = new PDO($db_dns, $db_user, $db_pass);
} catch (PDOException $e) {
    die('Error, try again later');
}

session_start();
