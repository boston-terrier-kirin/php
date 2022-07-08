<?php
class Database {
    private $conn;
    private $stmt;

    public function __construct() {
        $this->conn = $this->getConnection();
    }

    public function prepare($sql) {
        $this->stmt = $this->conn->prepare($sql);
    }

    public function bindValue($param, $value, $type = null) {
        if (is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) || empty($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute() {
        return $this->stmt->execute();
    }

    public function fetch() {
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll() {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rowCount() {
        return $this->stmt->rowCount();
    }

    public function lastInsertId() {
        return $this->conn->lastInsertId();
    }

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
