<?php 
    session_start();
    require_once '../conf.php';

    cfrs_check();

    if (!$_POST){
        redirect('/');
    }

    if (!post('phone') && !post('name') && !post('telegram')) {
        set_message('Заполните все поля');
    }

    if (!preg_match('/^\+*[0-9]{10,11}+$/', post('phone'))){
        set_message('Номер телефона указан неверно');
    }
    $phone = post('phone');

    if (!preg_match('/^[а-яё]{2,30}$/iu', post('name'))){
        set_message('Введите корректное имя на русском');
    }
    $name = post('name');
   
    if (!preg_match('/^\@*[a-zA-Z_0-9]{5,30}$/', post('telegram'))){
        set_message('Введите логин телеграм');
    }
    $telegram = post('telegram');

    $res = db_insert_model($name, $telegram, $phone);
    if ($res !== true){
        set_message('Создание заявки не удалось');
    }

    $res = send_notification_new_model($name, $telegram, $phone);
    if (!$res) {
        set_message('Отправка заявки не удалась');
    }

    set_message('Ваша заявка отправлена. Мы свяжемся с вами как можно скорее!', false);
