<?php
class UserGateway {
    private $conn;

    public function __construct($database) {
        $this->conn = $database->getConnection();
    }

    public function getByApiKey($key) {
        $sql = "select * from user where api_key = :api_key";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue("api_key", $key, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByUsername($username) {
        $sql = "select * from user where username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue("username", $username, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}