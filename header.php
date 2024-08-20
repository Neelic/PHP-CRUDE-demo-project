<?php
UserActions::signOut();
UserActions::signIn();
$user = UserLogic::current();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/Project/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/Project/css/style.css" rel="stylesheet">
</head>

<body>
    <header class="p-3 mb-3 border-bottom"
        style="top: 0; right: 0; left: 0; background-color: white; z-index: 999; display:block!important;">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <img src="/Project/images/Logo.png" alt="LOGO">
                </a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 link-secondary">О компании</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark" style="display: none;">Блог</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Адреса и контакты</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Монтаж</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Гарантия</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Поставищикам</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark" style="display: none;">Стать партнером</a></li>
                    <li><a href="/Project/lab4/text.php" class="nav-link px-2 link-dark">Текст</a></li>
                </ul>
                <!--<form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                        <input type="search" class="form-control" placeholder="Поиск" aria-label="Search">
                    </form>-->
                <div class="col-md-2 text-end"
                    style="<?php echo (0 < $_SESSION['USER_ID']) ? 'display: none' : 'display: block'; ?>">
                    <button type="button" class="btn btn-outline-primary me-2"
                        onclick="window.location.href = '/Project/login_form.php';">Вход</button>
                    <button type="button" class="btn btn-primary"
                        onclick="window.location.href = '/Project/register_form.php';">Регистрация</button>
                </div>
                <form method="post">
                    <div class="col text-end"
                        style="<?php echo (0 === $_SESSION['USER_ID']) ? 'display: none' : 'display: block'; ?>">
                        <p>Вы авторизировались как
                            <?php echo (count($user)) ? htmlspecialchars($user['email']) : '' ?>
                        </p>
                        <button type="submit" class="btn btn-outline-primary me-2" name="action"
                            value="signOut">Выход</button>
                    </div>
                </form>
            </div>
        </div>
    </header>