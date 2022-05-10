<?php
session_start();
require_once __DIR__ . '/conf.php';

$uri = cut_get_query($_SERVER['REQUEST_URI']);

if ($uri === '/') {
    require_once __DIR__ . '/view/pages/index.php';
} else {
    require_once __DIR__ . '/404.html';
}
