<?php

const USER = 'root';
const PASS = 'root';
const DBNAME = 'blog_db';
const DSN = 'mysql:host=o_mariadb;dbname=' . DBNAME;

try {
    $pdo = new PDO(DSN, USER, PASS);
} catch (PDOException $e) {
    echo '<pre>';
    var_dump($e);
    die('Error, try again later');
}
