<?php

require_once __DIR__ . '/modules/index.php';

define('DB_HOST', 'localhost');
define('DB_NAME', 'landos');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('SALT', 'si5X5DdiHkg9Hqtzoo1N5pItl0XIPw');
define('CFRS_TIME', 3600);

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_errno) {
    die();
}

// error_reporting(0);
// ini_set('display_errors', false);
error_reporting(E_ALL);
ini_set('display_errors', true);