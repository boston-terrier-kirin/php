<?php
class Database {

    public function getConnection() {
        $db_host = "localhost";
        $db_name = "php_cms";
        $db_user = "php_cms";
        $db_pass = "php_cms";
    
        $dsn = "mysql:host=" . $db_host . ";dbname=" . $db_name . ";charset=utf8";

        try {
            $db = new PDO($dsn, $db_user, $db_pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
?>