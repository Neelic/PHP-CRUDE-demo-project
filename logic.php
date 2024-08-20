<?php
//Работа с БД
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/db/db.php');
//Работа с пользователем
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/user/userTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/user/userLogic.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/user/userActions.php');
//Работа с охраниками и постами охраны
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/guardMan/guardActions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/guardMan/guardLogic.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/guardMan/guardTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/guardMan/securityPost/securityPostTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/guardMan/securityPost/securityPostLogic.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/guardMan/securityPost/securityPostActions.php');
//Инициализация сессии БД
Database::getInstance();
//Старт сессии
session_start();
if (!UserLogic::isAuthorized()) {
    $_SESSION['USER_ID'] = 0;
}

function redirectNonAuthUsers()
{
    if (!UserLogic::isAuthorized()) {
        header('Location: ' . '/Project/login_form.php');
    }
}

function SQLQueryToPosts()
{
    $query = Database::prepare("SELECT * from `security_post`");
    $query->execute();
    $resultArray = $query->fetchAll(PDO::FETCH_ASSOC);
    return $resultArray;
}

function SQLQueryWithParam(string $str, array $param)
{
    $strQuery = "SELECT * from `guard` join `security_post` on guard.security_post_id = security_post.id"; //Строка с SQL запросом
    if (strlen($str) > 0) {
        $strQuery .= ' where ' . $str;
    }
    $query = Database::prepare($strQuery);
    $query->execute($param);
    $resultArray = $query->fetchAll(PDO::FETCH_ASSOC);
    return $resultArray;
}

function errorStr(string $errorMesage): string
{
    return "<div class=\"invalid-feedback\" style=\"display: block; color: #b02a37;\">" . $errorMesage . "</div>";
}

function showAlertWindow(array $messages)
{
    $str = implode('\n', $messages);

    echo "<script type=\"text/javascript\">
            window.onload = function () { alert(\"$str\"); } 
        </script>";
}