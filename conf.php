<?php

require_once __DIR__ . '/modules/index.php';

define('DB_HOST', 'localhost');
define('DB_NAME', 'landos');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_errno) {
    die();
}