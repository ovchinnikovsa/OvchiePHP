<?php 
  require 'header.php';
?>

<!-- REGISTRATION -->

<?php 
  if(!isset($_SESSION["email"])){    
?>

  <form class="reg-log" name="registration" action="registration.php" method="POST">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
      <input require type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $email; ?>">
    <div id="emailHelp" class="form-text" name="email">Мы никогда никому не передадим вашу электронную почту.</div>
    </div>

    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Пароль</label>
      <input require type="password" class="form-control" id="InputPassword1" name="password">
      <div id="emailHelp" class="form-text">Минимальная длина пароля 8 символов.</div>
    </div>

    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Повторите пароль</label>
      <input require type="password" class="form-control" id="exampleInputPassword1" name="password_2">
    </div>
    
    <input type="submit" class="btn btn-primary" name="regButton" value="Регистрация">

<?php

  if (isset($_POST['email'])) {
    $email = $_POST['email'];
    if ($email == '') {
        unset($email);
    }
  }
  if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if ($password == '') {
        unset($password);
    }
  }

  $email = stripslashes($email);
  $email = htmlspecialchars($email);
  $password = stripslashes($password);
  $password = htmlspecialchars($password);

  $email = trim($email);
  $email = filter_var($email, FILTER_VALIDATE_EMAIL);
  $password = trim($password);

  $query = ("SELECT email FROM users WHERE email = '$email'");
  $checkDupl = $pdo->query($query);
  $checkDuplicationArray = $checkDupl->fetch();

 
  if (isset($_POST['regButton'])) {
    if ($email == '') { 
      echo '<div class="form-text reg-errors">Введите почту!</div>';
    } 
    elseif ($password == '') {     
      echo '<div class="form-text reg-errors">Введите пароль!</div>'; 
    }
    elseif (empty($email) || empty($password)){  
      echo '<div class="form-text reg-errors">Заполните все поля!</div>';
    }
    elseif (strlen($password) < 8) {   
      echo '<div class="form-text reg-errors">Пароль должен быть минимум 8 символов!</div>'; 
    }
    elseif ($_POST['password_2'] != $password) {      
      echo '<div class="form-text reg-errors">Пароли должны совпадать!</div>';     
    }
    elseif ($checkDuplicationArray['email'] === $email){  
      echo '<div class="form-text reg-errors">Такой электронный адрес уже существует</div>';
    }
    else{
      $pass_hash = password_hash($password, PASSWORD_DEFAULT); 
      $query = ("INSERT INTO users VALUES (NULL, :email, :password)");
      $checkDuplication = $pdo->prepare($query);
      $checkDuplication->execute(['email' => $email, 'password' => $pass_hash]);      
      echo '<div class="form-text" class="reg-sucsess">Регистрация прошла успешно!<a href="logIn.php">Войти</a></div>';
      /* header_remove("Location");
      header("HTTP/1.1 301 Moved Permanently");
      header("Location: /logIn.php"); */
      exit();
    }
  }
  
?>

  </form>

<?php 
  }else{ 
?>
  <div id="authorized">
    <h1>Вы уже зарегестрированы </h1>
    <a href="index.php">Ладно</a>
  </div>
<?php
  }
  require 'save_user.php';
?>