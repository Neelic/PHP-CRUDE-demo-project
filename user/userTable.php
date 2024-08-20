<?php class UserTable
{
    public static function create(
        string $email,
        string $password,
        string $fio,
        string $dob,
        string $address,
        bool $male,
        string $interests,
        string $vk,
        int $bloodType,
        bool $resFactor
    ) {
        $query = Database::prepare('INSERT INTO `user` (`email`, `password`, `fio`, `date_of_birth`, `address`, `male`,
         `interests`, `vk`, `blood_type`, `res_factor`) values (:email, :pass, :FIO, :dob, :addr, :male,
         :interests, :vk, :blood_type, :res_factor)');
        $query->bindValue(':email', $email);
        $query->bindValue(':pass', $password);
        $query->bindValue(':FIO', $fio);
        $query->bindValue(':dob', $dob);
        $query->bindValue(':addr', $address);
        $query->bindValue(':male', $male);
        $query->bindValue(':interests', $interests);
        $query->bindValue(':vk', $vk);
        if (0 === $bloodType) {
            $bloodType = null;
        }
        $query->bindValue(':blood_type', $bloodType);
        $query->bindValue(':res_factor', $resFactor);

        if (!$query->execute()) {
            throw new PDOException("User cannot add in database");
        }
    }

    public static function getByEmail(string $email): array
    {
        $query = Database::prepare("SELECT * from `user` where `email` = :email limit 1");
        $query->bindValue(':email', $email);
        $query->execute();
        $resultArray = $query->fetch();
        if (!$resultArray) {
            $resultArray = array();
        }
        return $resultArray;
    }

    public static function getById(int $id): array
    {
        $query = Database::prepare("SELECT * from `user` where `id` = :id limit 1");
        $query->bindValue(':id', $id);
        $query->execute();
        $resultArray = $query->fetch();
        return $resultArray;
    }
}
