<?php
class UserService {
    private $db;

    public static $loginColumnDef = [
        "username" => ["name" => "メールアドレス", "initValue" => "", "required" => true],
        "password" => ["name" => "パスワード", "initValue" => "", "required" => true],
    ];

    public static $registerColumnDef = [
        "username" => ["name" => "ユーザ名", "initValue" => "", "required" => true],
        "email" => ["name" => "メールアドレス", "initValue" => "", "required" => true],
        "password" => ["name" => "パスワード", "initValue" => "", "required" => true],
        "confirm_password" => ["name" => "パスワード(確認)", "initValue" => "", "required" => true],
    ];

    public function __construct() {
        $this->db = new Database();
    }

    public function validate($data) {
        $errors = Validator::validate(UserService::$loginColumnDef, $data);
        return $errors;
    }

    public function validateRegister($data) {
        $errors = [];
        $errors = Validator::validate(UserService::$registerColumnDef, $data);

        if (strlen($data["password"]) < 5) {
            $errors["password"] = "Password must be at least 5 charactors";
        }

        if ($data["password"] != $data["confirm_password"]) {
            $errors["confirm_password"] = "Password do not match";
        }

        return $errors;
    }

    public function authenticate($data) {
        $this->db->prepare("
            select *
              from users
             where user_name = :user_name
        ");

        $this->db->bindValue(":user_name", $data["username"]);
        $this->db->execute();
        $user = $this->db->fetch();

        if (!$user) {
            return false;
        }

        // TODO:PHP5.4 にはpassword_verifyがない。
        // return password_verify($data["password"], $user["password"]);
        return $data["password"] == $user["password"];
    }

    public function register($data) {
        $this->db->prepare("
            insert into users(user_name, email, password)
            values(:user_name, :email, :password) 
        ");

        // TODO:PHP5.4 にはpassword_hashがない。
        // $password = password_hash($data["password"], PASSWORD_DEFAULT);
        $password = $data["password"];

        $this->db->bindValue(":user_name", $data["username"]);
        $this->db->bindValue(":email", $data["email"]);
        $this->db->bindValue(":password", $password);
        $this->db->execute();
    }
}
