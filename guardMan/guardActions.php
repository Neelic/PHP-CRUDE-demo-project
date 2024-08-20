<?php class GuardActions
{
    public static function addGuard(): array
    {
        $result = array();
        if ('POST' != $_SERVER['REQUEST_METHOD']) {
            return $result;
        }

        if ('addGuard' != $_POST['action']) {
            return $result;
        }

        $result = GuardLogic::addGuard(
            $_POST['guardFio'], $_POST['guardDescription'], $_POST['guardPost'],
            $_POST['guardDoB'], $_FILES['guardIMG'],
            1
        );
        $_POST['action'] = '';

        if (!count($result)) {
            header('Location: ' . '/Project/lab2.php');
            die();
        }

        return $result;
    }

    public static function getGuards(): array
    {
        $result = array();

        if (array_key_exists('filtr', $_GET) && "Применить фильтр" === $_GET['filtr']) {
            $fio = $_GET['filtQueueFio'];
            $desc = $_GET['filtQueueDesc'];
            $post = $_GET['filtQueueName'];
            $DoB_Start = $_GET['filtQueueDoB1'];
            $DoB_End = $_GET['filtQueueDoB2'];
        } else {
            $fio = null;
            $desc = null;
            $post = null;
            $DoB_Start = null;
            $DoB_End = null;
        }

        $result = GuardTable::getList(1, $fio, $desc, $post, $DoB_Start, $DoB_End);
        if (!count($result)) {
            header('Location: ' . '/Project/lab2.php');
            die();
        }

        return $result;
    }

    public static function changeGuard(): array
    {
        $result = array();
        if ('POST' != $_SERVER['REQUEST_METHOD']) {
            return $result;
        }

        if ('changeGuard' != $_POST['action']) {
            return $result;
        }

        if (array_key_exists('guardIMG', $_FILES)) {
            $img = $_FILES['guardIMG'];
        } else {
            $img = null;
        }

        $result = GuardLogic::changeGuard(
            (int) $_POST['guardId'], $_POST['guardPost'], $_POST['guardFio'],
            $_POST['guardDescription'], $_POST['guardDoB'], $img
        );
        $_POST['action'] = '';

        if (!count($result)) {
            header('Location: ' . '/Project/lab2.php');
            die();
        }

        return $result;
    }

    public static function deleteGuard(): array
    {
        $result = array();
        if ('POST' != $_SERVER['REQUEST_METHOD']) {
            return $result;
        }

        if ('deleteGuard' != $_POST['action']) {
            return $result;
        }

        $result = GuardLogic::deleteGuard($_POST['guardId']);
        $_POST['action'] = '';

        if (!count($result)) {
            header('Location: ' . '/Project/lab2.php');
            die();
        }

        return $result;
    }
}