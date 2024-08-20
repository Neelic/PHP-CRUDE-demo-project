<?php class SecurityPostLogic
{
    public static function addPost(
        string $postName,
        string $location
    ): array {
        $errors = array();

        if (!$location) {
            $errors['postLocation'] = 'Неверное местонахождение';
        }

        if (!$postName) {
            $errors['postName'] = 'Неверное название поста';
        }

        if (!count($errors)) {
            SecurityPostTable::create($postName, $location);
        }

        return $errors;
    }

    public static function changePost(
        int $idPost,
        string|null $postName = null,
        string|null $location = null
    ): array {
        $errors = array();

        if (!$location) {
            $errors['postLocation'] = 'Неверное местонахождение';
        }

        if (!$postName) {
            $errors['postName'] = 'Неверное название поста';
        }

        if (!count($errors)) {
            SecurityPostTable::update($idPost, $postName, $location);
        }

        return $errors;
    }

    public static function deletePost(
        int $idPost
    ): array {
        $errors = array();

        $guardsOnPost = GuardTable::getGuardByPostId($idPost);

        if ($guardsOnPost) {
            $errors['delete'] = 'Нельзя удалить пост, так как на нем есть охранники';
        }

        if (!count($errors)) {
            SecurityPostTable::delete($idPost);
        }

        return $errors;
    }
}