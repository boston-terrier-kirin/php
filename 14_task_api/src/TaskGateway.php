<?php
class TaskGateway {
    private $conn;

    public function __construct($database) {
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $sql = "select * from task order by name";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($id) {
        $sql = "select * from task where id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue("id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "insert into task(name, priority, is_completed) values(:name, :priority, :is_completed)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue("name", $data["name"], PDO::PARAM_STR);
        $stmt->bindValue("priority", $data["priority"], PDO::PARAM_INT);
        $stmt->bindValue("is_completed", $data["is_completed"], PDO::PARAM_INT);
        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function update($id, $data) {
        $sql = "update task
                   set name = :name
                      ,priority = :priority
                      ,is_completed = :is_completed
                 where id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue("name", $data["name"], PDO::PARAM_STR);
        $stmt->bindValue("priority", $data["priority"], PDO::PARAM_INT);
        $stmt->bindValue("is_completed", $data["is_completed"], PDO::PARAM_INT);
        $stmt->bindValue("id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete($id) {
        $sql = "delete from task
                 where id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue("id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }
}