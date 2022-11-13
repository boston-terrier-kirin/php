<?php
class TaskGateway {
    private $conn;

    public function __construct($database) {
        $this->conn = $database->getConnection();
    }

    public function getAll($userId) {
        $sql = "select * from task where user_id = :user_id order by name";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue("user_id", $userId, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($userId, $id) {
        $sql = "select * from task where id = :id and user_id = :user_id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue("id", $id, PDO::PARAM_INT);
        $stmt->bindValue("user_id", $userId, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($userId, $data) {
        $sql = "insert into task(name, priority, is_completed, user_id) values(:name, :priority, :is_completed, :user_id)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue("name", $data["name"], PDO::PARAM_STR);
        $stmt->bindValue("priority", $data["priority"], PDO::PARAM_INT);
        $stmt->bindValue("is_completed", $data["is_completed"], PDO::PARAM_INT);
        $stmt->bindValue("user_id", $userId, PDO::PARAM_INT);

        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function update($userId, $id, $data) {
        $sql = "update task
                   set name = :name
                      ,priority = :priority
                      ,is_completed = :is_completed
                 where id = :id
                   and user_id = :user_id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue("name", $data["name"], PDO::PARAM_STR);
        $stmt->bindValue("priority", $data["priority"], PDO::PARAM_INT);
        $stmt->bindValue("is_completed", $data["is_completed"], PDO::PARAM_INT);
        $stmt->bindValue("id", $id, PDO::PARAM_INT);
        $stmt->bindValue("user_id", $userId, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete($userId, $id) {
        $sql = "delete from task
                 where id = :id
                   and user_id = :user_id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue("id", $id, PDO::PARAM_INT);
        $stmt->bindValue("user_id", $userId, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }
}