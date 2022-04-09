<?php 

function dd($var)
{
    var_dump($var);
    die();
}

function post($key, $value = 'not defined'){
    if ($value === 'not defined') {
        return $_POST[$key];
    }
    $_POST[$key] = $value;
}