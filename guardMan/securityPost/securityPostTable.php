<?php class SecurityPostTable
{
    public static function create(
        string $postName,
        string $location
    ): void {
        $query = Database::prepare("INSERT into `security_post` (`name`, `location`) values (:postName, :locat)");
        $query->bindValue(':postName', $postName);
        $query->bindValue(':locat', $location);

        if (!$query->execute()) {
            throw new PDOException("Post cannot add in database");
        }
    }

    public static function update(
        int $idPost,
        string|null $postName = null,
        string|null $location = null
    ): void {
        $sqlQuery = 'UPDATE `security_post` ';
        $parametrs = array();

        if ($postName) {
            $sqlQuery .= "SET `name` = :postName";
            $parametrs[':postName'] = $postName;
        }
        if ($location) {
            if (!mb_strpos($sqlQuery, 'SET')) {
                $sqlQuery .= "SET ";
            } else {
                $sqlQuery .= ", ";
            }

            $sqlQuery .= "`location` = :location";
            $parametrs[':location'] = $location; 
        }

        $sqlQuery .= " WHERE id_post = $idPost";

        if (strpos($sqlQuery, 'SET')) {
            $query = Database::prepare($sqlQuery);
            if (!$query->execute($parametrs)) {
                throw new PDOException('Post nod update');
            }
        }
    }

    public static function delete(int $idPost): void
    {
        $query = Database::prepare("DELETE FROM `security_post` where id_post = $idPost");
        if (!$query->execute()) {
            throw new PDOException('Post nod delete');
        }
    }

    public static function getPosts(): array
    {
        $strQuery = "SELECT * from `security_post`"; //Строка с SQL запросом
        $query = Database::prepare($strQuery);
        $query->execute();
        $resultArray = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultArray;
    }

    public static function getPostByID(int $Id = 0): array
    {
        $strQuery = "SELECT * from `security_post` where id_post=$Id"; //Строка с SQL запросом
        $query = Database::prepare($strQuery);
        $query->execute();
        $resultArray = $query->fetch(PDO::FETCH_ASSOC);
        return $resultArray;
    }

    public static function getPostByName(string $postName): array
    {
        $strQuery = "SELECT * from `security_post` where `name`=\"$postName\""; //Строка с SQL запросом
        $query = Database::prepare($strQuery);
        $query->execute();
        $resultArray = $query->fetch(PDO::FETCH_ASSOC);
        return $resultArray;
    }
}