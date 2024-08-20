<?php class UserLogic
{
    public static function signUp(
        string $email,
        string $password,
        string $password_confirm,
        string $fio,
        string $dob,
        string $address,
        bool $male,
        string $interests,
        string $vk,
        int $bloodType,
        bool $resFactor
    ): array {
        $errors = array();
        if (!static::isAuthorized()) {
            $errors = array();
            //Проверка на существующего пользователя
            if (count(UserTable::getByEmail($email))) {
                $errors['email'] = 'Такой пользователь уже есть';
            }
            //Валидация пароля
            if (
                !preg_match(
                    '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[[:punct:]])(?=.*\d)(?=.*\s)(?=.*[^А-я])[a-zA-Z\d\s[[:punct:]]{6,}$/',
                    $password
                )
            ) {
                $errors['pass'] = 'Пароль должен быть длиннее 6 символов, содержать большие латинские буквы, маленькие латинские буквы, спецсимволы, пробел, дефис, подчеркивание и цифры.';
            }
            //Проверка на совпадение паролей
            if ($password !== $password_confirm) {
                $errors['pass_confirm'] = 'Пароли не совпадают';
            }

            if (count($errors)) {
                return $errors;
            }

            UserTable::create(
                $email,
                password_hash($password, PASSWORD_DEFAULT),
                $fio,
                $dob,
                $address,
                $male,
                $interests,
                $vk,
                $bloodType,
                $resFactor
            );

            $user = UserTable::getByEmail($_POST['email']);
            $_SESSION['USER_ID'] = $user['id'];
        }
        return $errors;
    }

    public static function signIn(string $email, string $password): array
    {
        $errors = array();

        $user = UserTable::getByEmail($email);
        if (null == $user) {
            $errors['email'] = 'Неверно указан email';
        }

        if (!count($errors) && !password_verify($password, $user['password'])) {
            $errors['pass'] = 'Неверно указан пароль';
        }

        if (!count($errors)) {
            $_SESSION['USER_ID'] = $user['id'];
        }

        return $errors;
    }

    public static function isAuthorized(): bool
    {
        return intval($_SESSION['USER_ID']) > 0;
    }

    public static function current(): array
    {
        if (!static::isAuthorized()) {
            return array();
        }

        return UserTable::getById($_SESSION['USER_ID']);
    }
}