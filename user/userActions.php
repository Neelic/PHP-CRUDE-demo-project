<?php class UserActions
{
    public static function signIn(): array
    {
        $result = array();
        if ('POST' != $_SERVER['REQUEST_METHOD']) {
            return $result;
        }

        if ('signIn' != $_POST['action']) {
            return $result;
        }

        if (UserLogic::isAuthorized()) {
            return $result;
        }

        $result = UserLogic::signIn($_POST['email'], $_POST['password']);
        $_POST['password'] = '';
        $_POST['action'] = ''; 

        if (!count($result)) {
            header('Location: ' . '/Project/lab2.php');
            die();
        }

        return $result;
    }

    public static function signOut(): string
    {
        $result = '';

        if ('POST' != $_SERVER['REQUEST_METHOD']) {
            return $result;
        }

        if ('signOut' === $_POST['action']) {
            $_SESSION['USER_ID'] = 0;
        }

        return $result;
    }

    public static function signUp(): array
    {
        if ('POST' != $_SERVER['REQUEST_METHOD']) {
            return [];
        }

        if ('signUp' != $_POST['action']) {
            return [];
        }

        $errors = UserLogic::signUp(
            $_POST['email'],
            $_POST['password'],
            $_POST['password_confirm'],
            $_POST['fio'],
            $_POST['DoB'],
            $_POST['address'],
            $_POST['male'],
            $_POST['interests'],
            $_POST['vk'],
            (int) $_POST['bloodType'],
            $_POST['resFactor']
        );
        $_POST['password'] = '';
        $_POST['action'] = '';

        if (!count($errors)) {
            header('Location: ' . '/Project/lab2.php' . '?success=y');
            die();
        }

        return $errors;
    }
}