<?php

require_once __DIR__ . '/modules/index.php';
require_once __DIR__ . '/vendor/autoload.php';

define('DB_HOST', 'localhost');
define('DB_NAME', 'u1655554_default');
define('DB_USER', 'u1655554_default');
define('DB_PASSWORD', '1ZZ7nHmnrYNZb99L');
// define('DB_NAME', 'landos');
// define('DB_USER', 'root');
// define('DB_PASSWORD', '');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('SALT', 'si5X5DdiHkg9Hqtzoo1N5pItl0XIPw');
define('CFRS_TIME', 3600);

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_errno) {
    die();
}

mysqli_set_charset($mysqli, "utf8");

error_reporting(0);
ini_set('display_errors', false);