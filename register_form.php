<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/logic.php');
$errors = UserActions::signUp();
$isEmailError = array_key_exists('email', $errors);
$isPassError = array_key_exists('pass', $errors);
$isPassConfError = array_key_exists('pass_confirm', $errors);
$isBloodType = array_key_exists('bloodType', $_POST);
$isMale = array_key_exists('male', $_POST);
$isResFactor = array_key_exists('resFactor', $_POST);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/Project/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="/Project/css/style_forms.css">
  <title>Регистрация</title>
</head>
<body class="text-center">
  <main class="form-signin w-100 m-auto">
    <form method="post" id="registerForm">
      <a href="/Project/index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none" style="margin-left: 135px;">
        <img src="/Project/images/Logo.png" alt="LOGO">
      </a>
      <h1 class="h3 mb-3 fw-normal">Регистрация</h1>
      <div class="form-floating">
        <input type="email" class="form-control <?php echo ($isEmailError) ? 'is-invalid' : ''?>" id="floatingInput" name="email" placeholder="name@example.com" value="<?php echo (array_key_exists('email', $_POST)) ? $_POST['email'] : ''?>">
        <label for="floatingInput">Email</label>
        <?php echo ($isEmailError) ? errorStr($errors['email']) : ''?>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control <?php echo ($isPassError) ? 'is-invalid' : ''?>" id="floatingPassword" name="password" placeholder="Password">
        <label for="floatingPassword">Пароль</label>
        <?php echo ($isPassError) ? errorStr($errors['pass']) : ''?>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control <?php echo ($isPassConfError) ? 'is-invalid' : ''?>" id="floatingPasswordOther" name="password_confirm" placeholder="Password">
        <label for="floatingPasswordOther">Повторите пароль</label>
        <?php echo ($isPassConfError) ? errorStr($errors['pass_confirm']) : ''?>
      </div>
      <div>Поля, необязательные к заполнению</div>
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingFIO" name="fio" placeholder="FIO" value="<?php echo (array_key_exists('fio', $_POST)) ? $_POST['fio'] : ''?>">
        <label for="floatingFIO">ФИО</label>
      </div>
      <div class="form-floating">
        <input type="date" class="form-control" id="floatingDoB" name="DoB" placeholder="DoB" value="<?php echo (array_key_exists('DoB', $_POST)) ? $_POST['DoB'] : ''?>">
        <label for="floatingDoB">Дата рождения</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingAddres" name="address" placeholder="Address" value="<?php echo (array_key_exists('address', $_POST)) ? $_POST['email'] : ''?>">
        <label for="floatingAddress">Адрес</label>
      </div>
      <div class="mb-3" style="margin-bottom: 0px !important;">
          <select class="form-select form-select-sm" name="male" aria-label=".form-select-sm example">
            <option value="" selected="">Выберите пол</option>
            <option value="1" <?php echo ($isMale && $_POST['male']) ? 'selected' : ''?>>Мужской</option>
            <option value="0" <?php echo ($isMale && !$_POST['male']) ? 'selected' : ''?>>Женский</option>
          </select>
        </div>
        <div class="input-group">
          <span class="input-group-text">Интересы</span>
          <textarea class="form-control" aria-label="With textarea" name="interests" form="registerForm" value="<?php echo (array_key_exists('interests', $_POST)) ? $_POST['interests'] : ''?>"></textarea>
        </div>
        <div class="input-group mb-3" style="margin-bottom: 0px !important;">
          <span class="input-group-text" id="basic-addon1">VK</span>
          <input type="text" class="form-control" placeholder="Ссылка на ваш Вконтакте" name="vk" aria-label="VK" aria-describedby="basic-addon1" value="<?php echo (array_key_exists('vk', $_POST)) ? $_POST['vk'] : ''?>">
        </div>
        <div class="mb-3" style="margin-bottom: 0px !important;">
          <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="bloodType">
            <option value="0" selected="">Выберите группу крови</option>
            <option value="1" <?php echo ($isBloodType && $_POST['bloodType'] == 1) ? 'selected' : ''?>>I</option>
            <option value="2" <?php echo ($isBloodType && $_POST['bloodType'] == 2) ? 'selected' : ''?>>II</option>
            <option value="3" <?php echo ($isBloodType && $_POST['bloodType'] == 3) ? 'selected' : ''?>>III</option>
            <option value="4" <?php echo ($isBloodType && $_POST['bloodType'] == 4) ? 'selected' : ''?>>IV</option>
          </select>
        </div>
        <div class="mb-3">
          <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="resFactor">
            <option value="" selected="">Выберите резус-фактор</option>
            <option value="true" <?php echo ($isResFactor && $_POST['resFactor']) ? 'selected' : ''?>>Положительный</option>
            <option value="false" <?php echo ($isResFactor && !$_POST['resFactor']) ? 'selected' : ''?>>Отрицательный</option>
          </select>
        </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Зарегистрироваться</button>
      <div class="text-left">
        <div class="row">
          <div class="col-1">или</div>
          <div class="col-1">
            <a href="/Project/login_form.php">Войти</a>
          </div>
        </div>
      </div>
      <p class="mt-5 mb-3 text-muted">© 2022–2023</p>
      <input type="text" name="action" value="signUp" style="visibility: hidden;">
    </form>
  </main>

  <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>