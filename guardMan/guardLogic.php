<?php
class GuardLogic
{
    public static function addGuard(
        string $Fio,
        string $description,
        string $post,
        string $DoB,
        array|null $img,
        int $idUser
    ): array {
        $result = array();

        $date = new DateTime($DoB);
        $nowDate = new DateTime();
        if ($date->format('Y-m-d') > $nowDate->format('Y-m-d')) {
            $result['DoB'] = 'Неверная дата рождения';
        }

        $post = SecurityPostTable::getPostByName($post)['id_post'];

        if (!$post) {
            $result['post'] = 'Неверный пост охраны';
        }

        //Загрузка изображения
        if (!self::uploadFile($img)) {
            $result['img'] = 'Файл не был загружен';
        }

        if (!count($result)) {
            GuardTable::create($Fio, $description, (int) $post, $DoB, $img['name'], $idUser);
        }

        return $result;
    }

    public static function changeGuard(
        int $idGuard,
        string|null $postName,
        string|null $fio = null,
        string|null $description = null,
        string|null $DoB = null,
        array|null $img = null
    ): array {
        $result = array();

        $postName = SecurityPostTable::getPostByName($postName)['id_post'];

        if (!$postName) {
            $result['postName'] = 'Неверный пост';
        }

        if (!$fio) {
            $result['fio'] = 'Неверное ФИО охранника';
        }

        if ($img != null && !$img['error']) {

            try {
                self::deleteImgById($idGuard);
            } catch (Throwable $th) {
                $result['delete'] = 'Не удалось удалить изображение';
            }

            if (!self::uploadFile($img)) {
                $result['img'] = 'Файл не был загружен';
            }
        }

        if (!count($result)) {
            GuardTable::update($idGuard, $fio, $description, $postName, $DoB, $img['name']);
        }

        return $result;
    }

    public static function deleteGuard(int $idGuard): array
    {
        $result = array();
        $imgPath = GuardTable::getGuardById($idGuard)['img_path'];

        if ($imgPath) {
            try {
                self::deleteImgById($idGuard);
            } catch (Throwable $th) {
                $result['delete'] = 'Не удалось удалить изображение';
            }
        }

        if (!count($result)) {
            GuardTable::delete($idGuard);
        }

        return $result;
    }

    private static function uploadFile(array $img): bool
    {
        $uploadFile = 'C:/xampp/htdocs/Project/images/' . basename($img['name']);
        if (!move_uploaded_file($img['tmp_name'], $uploadFile)) {
            return false;
        }

        return true;
    }

    private static function deleteImgById(int $idGuard): void
    {
        $imgPath = GuardTable::getGuardById($idGuard)['img_path'];

        if ($imgPath) {
            unlink("C:/xampp/htdocs/Project/images/$imgPath");
        }
    }
}