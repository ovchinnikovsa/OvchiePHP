<?php require 'header.php' ?>
    
<!-- LOGIN -->

<?php
  if(!isset($_SESSION["email"])){
?>

  <form class="reg-log" name="logIn" action="logIn.php" method="POST">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
        <input required type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">Мы никогда никому не передадим вашу электронную почту.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input required type="password" name="password" class="form-control" id="exampleInputPassword1">
        <div id="emailHelp" class="form-text">Минимальная длина пароля 8 символов.</div>
      </div>
      <button type="submit" name="singinButton" class="btn btn-primary">Войти</button>

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

  $query = ("SELECT * FROM users WHERE email = '$email'");
  $checkForUser = $pdo->query($query);
  $checkForUserArray = $checkForUser->fetch();
  $passHashFromBd = $checkForUserArray['password'];
 
  if (isset($_POST['singinButton'])) {
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
    elseif ($checkForUserArray['email'] === $email && password_verify($password, $passHashFromBd)){  
      $_SESSION['email'] = $email;     
      echo '<div class="form-text reg-sucsess">Вы вошли!<a href="index.php">На главную</a></div>';
      /* header_remove("Location");
      header("HTTP/1.1 301 Moved Permanently");
      header("Location: /index.php"); */
      exit();
    }else{
      echo '<div class="form-text reg-errors">Неверный пароль или почта!</div>';
      exit();
    }
  }
?>

  </form>

<?php
  }else{
?>
 
    <div id="authorized">
        <h2>Вы уже авторизованы</h2>
        <a href="index.php">Ладно</a>
    </div>
 
<?php
  }
?>
 