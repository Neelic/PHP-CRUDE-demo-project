<?php class SecurityPostActions
{
    public static function addPost(): array
    {
        $result = array();
        if ('POST' != $_SERVER['REQUEST_METHOD']) {
            return $result;
        }

        if ('addPost' != $_POST['action']) {
            return $result;
        }

        $result = SecurityPostLogic::addPost($_POST['postName'], $_POST['postLocation']);
        $_POST['action'] = '';

        if (!count($result)) {
            header('Location: ' . '/Project/lab2.php');
            die();
        }

        return $result;
    }

    public static function changePost(): array
    {
        $result = array();
        if ('POST' != $_SERVER['REQUEST_METHOD']) {
            return $result;
        }

        if ('changePost' != $_POST['action']) {
            return $result;
        }

        $result = SecurityPostLogic::changePost($_POST['postId'], $_POST['postName'], $_POST['postLocation']);
        $_POST['action'] = '';

        if (!count($result)) {
            header('Location: ' . '/Project/lab2.php');
            die();
        }

        return $result;
    }

    public static function deletePost(): array
    {
        $result = array();
        if ('POST' != $_SERVER['REQUEST_METHOD']) {
            return $result;
        }

        if ('deletePost' != $_POST['action']) {
            return $result;
        }

        $result = SecurityPostLogic::deletePost($_POST['postId']);
        $_POST['action'] = '';

        if (!count($result)) {
            header('Location: ' . '/Project/lab2.php');
            die();
        }

        return $result;
    }
}