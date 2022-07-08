<?php
class Database {

    public function getConnection() {
        $db_host = DB_HOST;
        $db_name = DB_NAME;
        $db_user = DB_USER;
        $db_pass = DB_PASS;
    
        $dsn = "mysql:host=" . $db_host . ";dbname=" . $db_name . ";charset=utf8";
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );

        try {
            $db = new PDO($dsn, $db_user, $db_pass, $options);
            return $db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
