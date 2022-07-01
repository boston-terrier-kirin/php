<?php
class Database {
    private static $connection;

    public static function getConnection() {
        if (self::$connection === null) {
            $dsn = "mysql:host=localhost;dbname=php_task;charset=utf8";
            self::$connection = new PDO($dsn, "php_task", "php_task");
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

        return self::$connection;
    }
}
?>