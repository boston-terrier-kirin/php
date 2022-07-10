<?php
class UserService {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function authenticate($username, $password) {
        $this->db->prepare("
            select *
              from users
             where user_name = :user_name
        ");

        $this->db->bindValue(":user_name", $username);
        $this->db->execute();
        $user = $this->db->fetch();

        if (!$user) {
            return false;
        }

        // TODO:PHP5.4 にはpassword_verifyがない。
        return password_verify($password, $user["password"]);
    }

    public function register($username, $email, $password) {
        $this->db->prepare("
            insert into users(user_name, email, password)
            values(:user_name, :email, :password) 
        ");

        // TODO:PHP5.4 にはpassword_hashがない。
        $password = password_hash($password, PASSWORD_DEFAULT);

        $this->db->bindValue(":user_name", $username);
        $this->db->bindValue(":email", $email);
        $this->db->bindValue(":password", $password);
        $this->db->execute();
    }

    public static function validateRegister($username, $email, $password, $confirmPassword) {
        $errors = [];

        if (empty($username)) {
            $errors["username"] = "Username is required";
        }

        if (empty($email)) {
            $errors["email"] = "Email is required";
        }

        if (empty($password)) {
            $errors["password"] = "Password is required";
        } elseif (strlen($password) < 5) {
            $errors["password"] = "Password must be at least 5 charactors";
        }

        if (empty($confirmPassword)) {
            $errors["confirm_password"] = "Confirm Password is required";
        } else {
            if ($password != $confirmPassword) {
                $errors["confirm_password"] = "Password do not match";
            }
        }

        return $errors;
    }
}
