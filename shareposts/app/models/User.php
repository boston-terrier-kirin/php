<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function findUserByEmail($email) {
        $this->db->query("
            select *
              from users
             where email = :email
        ");

        $this->db->bind(":email", $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function register($data) {
        $this->db->query("
            insert into users(name, email, password)
            values(:name, :email, :password)
        ");

        $this->db->bind(":name", $data["name"]);
        $this->db->bind(":email", $data["email"]);
        $this->db->bind(":password", $data["password"]);

        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function login($email, $password) {
        $this->db->query("
            select *
              from users
             where email = :email
        ");

        $this->db->bind(":email", $email);
        
        $row = $this->db->single();
        $hased_passwrod = $row->password;

        if (password_verify($password, $hased_passwrod)) {
            return $row;
        }

        return false;
    }
}