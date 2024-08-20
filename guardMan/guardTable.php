<?php class GuardTable
{
    public static function create(
        string $Fio,
        string $description,
        int $post,
        string $DoB,
        string|null $imgPath,
        int $idUser
    ):void {
        $query = Database::prepare('INSERT INTO `guard` (`fio`, `description`, `date_of_birth`, `security_post_id`, `id_user`, `img_path`)
        values (:fio, :descr, :dob, :post, :idUser, :imgPath)');

        $query->bindValue(':fio', $Fio);
        $query->bindValue(':descr', $description);
        $query->bindValue(':dob', $DoB);
        $query->bindValue(':post', $post);
        $query->bindValue(':idUser', $idUser);
        $query->bindValue(':imgPath', $imgPath);

        if (!$query->execute()) {
            throw new PDOException("User cannot add in database");
        }
    }

    public static function getList(
        int $userId = 0,
        string|null $filtrFio = null,
        string|null $description = null,
        string|null $postName = null,
        string|null $startDoB = null,
        string|null $endDob = null
    ): array {
        $str = ""; //Строка с SQL запросом
        $cols = array('fio', 'description', 'name', 'date_of_birth'); //Используемые колонки в таблице
        $params = array();

        if ($filtrFio) {
            $params['fio'] = '%' . $filtrFio . '%';
            $str .= "$cols[0] like :fio ";
        }
        if ($description) {
            $params['desc'] = "%" . $description . '%';
            if (strpos($str, 'like')) {
                $str .= 'and ';
            }
            $str .= "$cols[1] like :desc ";
        }
        if ($postName) {
            $params['name'] = $postName;
            if (strpos($str, 'like')) {
                $str .= 'and ';
            }
            $str .= "$cols[2] = :name ";
        }
        if ($startDoB) {
            $params['DoBBefore'] = $startDoB;
        }
        if ($endDob) {
            $params['DoBAfter'] = $endDob;

            if (strpos($str, 'like')) {
                $str .= 'and ';
            }
            if (array_key_exists('DoBBefore', $params) && $params['DoBBefore'] < $params['DoBAfter']) {
                $str .= "$cols[3] between :DoBBefore and :DoBAfter ";
            } else {
                $str .= "$cols[3] = :DoBAfter";
            }
        }

        if (strpos($str, 'like')) {
            $str .= 'and ';
        }
        $str .= " guard.id_user = " . $userId;

        $strQuery = "SELECT * from `guard` join `security_post` on guard.security_post_id = security_post.id_post"; //Строка с SQL запросом
        $strQuery .= ' where ' . $str;

        $query = Database::prepare($strQuery);
        $query->execute($params);
        $resultArray = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultArray;
    }

    public static function delete(int $idGuard): void
    {
        $query = Database::prepare("DELETE FROM `guard` where id = $idGuard");
        if (!$query->execute()) {
            throw new PDOException('Guard nod delete');
        }
    }

    public static function update(
        int $idGuard,
        string|null $fio = null,
        string|null $description = null,
        int|null $postName = null,
        string|null $DoB = null,
        string|null $imgPath = null
    ): void {
        $sqlQuery = 'UPDATE `guard` ';
        $parametrs = array();

        if ($fio) {
            $sqlQuery .= "SET `fio` = :fio";
            $parametrs[':fio'] = $fio;
        }
        if ($description) {
            if (!mb_strpos($sqlQuery, 'SET')) {
                $sqlQuery .= "SET ";
            } else {
                $sqlQuery .= ", ";
            }

            $sqlQuery .= "`description` = :desc";
            $parametrs[':desc'] = $description;
        }
        if ($postName) {
            if (!mb_strpos($sqlQuery, 'SET')) {
                $sqlQuery .= "SET ";
            } else {
                $sqlQuery .= ", ";
            }

            $sqlQuery .= "`security_post_id` = $postName";
        }
        if ($DoB) {
            if (!mb_strpos($sqlQuery, 'SET')) {
                $sqlQuery .= "SET ";
            } else {
                $sqlQuery .= ", ";
            }

            $sqlQuery .= "`date_of_birth` = :DoB";
            $parametrs[':DoB'] = $DoB;
        }
        if ($imgPath) {
            if (!mb_strpos($sqlQuery, 'SET')) {
                $sqlQuery .= "SET ";
            } else {
                $sqlQuery .= ", ";
            }

            $sqlQuery .= "`img_path` = :img";
            $parametrs[':img'] = $imgPath;
        }

        $sqlQuery .= " WHERE id = $idGuard";

        if (strpos($sqlQuery, 'SET')) {
            $query = Database::prepare($sqlQuery);
            if (!$query->execute($parametrs)) {
                throw new PDOException('Guard nod update');
            }
        }
    }

    public static function getGuardById(int $id): array|bool
    {
        $strQuery = "SELECT * from `guard` where id=$id"; //Строка с SQL запросом
        $query = Database::prepare($strQuery);
        $query->execute();
        $resultArray = $query->fetch(PDO::FETCH_ASSOC);
        return $resultArray;
    }

    public static function getGuardByPostId(int $id): array|bool
    {
        $strQuery = "SELECT * from `guard` where security_post_id=$id"; //Строка с SQL запросом
        $query = Database::prepare($strQuery);
        $query->execute();
        $resultArray = $query->fetch(PDO::FETCH_ASSOC);

        return $resultArray;
    }
}