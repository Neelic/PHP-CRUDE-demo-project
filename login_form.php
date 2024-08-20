<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/logic.php');
$errors = UserActions::signIn();
$isEmailError = array_key_exists('email', $errors);
$isPassError = array_key_exists('pass', $errors);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/Project/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="/Project/css/style_forms.css">
  <title>Вход</title>
</head>

<body>
  <?php //require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/header.php') ?>
  <div class="text-center">
    <main class="form-signin w-100 m-auto">
      <form method="post" action="">
        <a href="/Project/index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none" style="margin-left: 120px;">
          <img src="/Project/images/Logo.png" alt="LOGO">
        </a>
        <h1 class="h3 mb-3 fw-normal">Вход</h1>
        <div class="form-floating">
          <input type="email" class="form-control <?php echo ($isEmailError) ? 'is-invalid' : ''?>" id="floatingInput" placeholder="name@example.com" name="email" value="<?php echo (array_key_exists('email', $_POST)) ? $_POST['email'] : ''?>">
          <label for="floatingInput">Email</label>
          <?php echo ($isEmailError) ? errorStr($errors['email']) : ''?>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control <?php echo ($isPassError) ? 'is-invalid' : ''?>" id="floatingPassword" placeholder="Password" name="password">
          <label for="floatingPassword">Пароль</label>
          <?php echo ($isPassError) ? errorStr($errors['pass']) : ''?>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" onclick="window.location.href = '/Project/index.php';">Войти</button>
        <div class="text-left">
          <div class="row">
            <div class="col-1">или</div>
            <div class="col-1">
              <a href="/Project/register_form.php">Зарегистрироваться</a>
            </div>
          </div>
        </div>
        <p class="mt-5 mb-3 text-muted">© 2022–2023</p>
        <input type="text" name="action" value="signIn" style="visibility: hidden;">
      </form>
    </main>
  </div>
  <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>