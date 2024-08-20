<?php class Database 
{
    private static $instance = null;
    private $connection = null;
    
    protected function __construct()
    {
        //echo ($_SERVER['DOCUMENT_ROOT']."/Project/config_db.php");
        require_once($_SERVER['DOCUMENT_ROOT']."/Project/db/config_db.php");
        $this->connection = new PDO ("mysql:host=$host;dbname=$dbname;", $username, $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //чтобы выбрасывало исключения
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //по умолчанию использовать имена столбцов
                PDO::ATTR_EMULATE_PREPARES => false //чтобы использовалась подготовка к запросу на уровне БД
            ]
        );
    }
    protected function __clone() {}
    public function __wakeup() {
        throw new Exception('method not available');
    }

    public static function getInstance(): Database 
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public static function connection(): PDO 
    {
        return static::getInstance()->connection;
    }

    public static function prepare($statement): PDOStatement 
    {
        return static::connection()->prepare($statement);
    }

    public static function lastInseredID(): int 
    {
        return intval(static::connection()->lastInsertId());
    }
}

