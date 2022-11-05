<?php
class User {
    public $id;
    public $username;
    public $password;

    public static function authenticate($conn, $username, $password) {

        $sql = "select *
                  from user
                 where username = :username";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User");

        $user = $stmt->fetch();

        return password_verify($password, $user->password);
    }
}
?>