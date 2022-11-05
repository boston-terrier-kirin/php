<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function authenticate($username, $password) {
        $sql = "select *
                  from user
                 where username = :username";

        $conn = $this->db->getConnection();        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User");

        $user = $stmt->fetch();

        if (!$user) {
            return false;
        }

        return password_verify($password, $user->password);
    }
}
