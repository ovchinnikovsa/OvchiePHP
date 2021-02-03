<?php
  require 'db.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="styles/style.css" rel="stylesheet" >
    <link rel="shortcut icon" href="img/LOGO1.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    <title>SimpleBlog</title>
  </head>


  <!-- HEADER -->
  <body class="container-xxl">
    <header>
        <nav  class="navbar navbar-dark bg-dark px-4">
            <div class="container-fluid ">
              <a href="index.php" class="navbar-brand">SimpleBlog</a>
              <form class="justify-content-center">

                <?php 
                  if (!isset($_SESSION['email'])) {
                    echo '<button name="buttonToReg" type="submit" class="btn btn-outline-light px-4"><a href="registration.php">Регистрация</a></button>
                          <button name="buttonToLog" type="submit" class="btn btn-outline-light px-4"><a href="logIn.php">Войти</a></button>';
                  } else {
                    echo '<button type="button" class="btn btn-secondary btn-lg" disabled>' . $_SESSION['email'] . '</button>
                          <button name="buttonToLog" type="submit" class="btn btn-outline-light px-4"><a href="logOut.php">Выйти</a></button>';
                  }
                ?>
              </form>
            </div>
        </nav>
    </header>