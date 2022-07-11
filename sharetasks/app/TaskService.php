<?php
class TaskService {
    private $db;

    public static $columnDef = [
        "register_user" => ["name" => "登録者", "initValue" => "", "required" => true],
        "register_date" => ["name" => "登録日", "initValue" => "", "required" => true],
        "assignee" => ["name" => "担当者", "initValue" => "", "required" => false],
        "target_system" => ["name" => "対象システム", "initValue" => "", "required" => false],
        "title" => ["name" => "タイトル", "initValue" => "", "required" => false],
        "content" => ["name" => "内容", "initValue" => "", "required" => false],
        "status" => ["name" => "ステータス", "initValue" => "", "required" => false],
        "plan_start_date" => ["name" => "開始予定日", "initValue" => "", "required" => false],
        "actual_start_date" => ["name" => "開始日", "initValue" => "", "required" => false],
        "plan_end_date" => ["name" => "終了予定日", "initValue" => "", "required" => false],
        "actual_end_date" => ["name" => "終了日", "initValue" => "", "required" => false],
        "comment" => ["name" => "コメント", "initValue" => "", "required" => false],
    ];

    public function __construct() {
        $this->db = new Database();
    }

    public function validate($data) {
        $errors = Validator::validate(TaskService::$columnDef, $data);
        return $errors;
    }

    public function getTasks($offset, $size) {
        $this->db->prepare("
            select task_id
                ,register_user
                ,register_date
                ,assignee
                ,target_system
                ,title
                ,content
                ,status
                ,plan_start_date
                ,plan_end_date
                ,actual_start_date
                ,actual_end_date
                ,comment
                ,create_user
                ,create_date
                ,update_user
                ,update_date
            from tasks
            order by task_id desc
            limit $offset, $size
        ");

        $this->db->execute();

        return $this->db->fetchAll();
    }

    public function count() {
        $this->db->prepare("
            select count(*) cnt
              from tasks
        ");

        $this->db->execute();

        return $this->db->fetch();
    }

    public function getById($taskId) {
        if (!is_numeric($taskId)) {
            return null;
        }
    
        $this->db->prepare("
            select *
              from tasks
             where task_id = :task_id
        ");

        $this->db->bindValue(":task_id", $taskId);
        $this->db->execute();

        return $this->db->fetch();
    }

    public function createTask($data) {

        try {
            $this->db->beginTransaction();

            $taskId = $this->insert($data);

            $attachService = new AttachService();
            $attachService->uploadFile($taskId, $data["upload_file"]);

            $this->db->commit();

        } catch (PDOException $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    private function insert($data) {
        $this->db->prepare("
            insert into tasks(register_user, register_date, assignee, target_system, title, content, status, plan_start_date, actual_start_date, plan_end_date, actual_end_date, comment, create_user, create_date)
            values(:register_user, :register_date, :assignee, :target_system, :title, :content, :status, :plan_start_date, :actual_start_date, :plan_end_date, :actual_end_date, :comment, :create_user, current_timestamp)
        ");

        $this->db->bindValue(":register_user", $data["register_user"]);
        $this->db->bindValue(":register_date", $data["register_date"]);
        $this->db->bindValue(":assignee", $data["assignee"]);
        $this->db->bindValue(":target_system", $data["target_system"]);
        $this->db->bindValue(":title", $data["title"]);
        $this->db->bindValue(":content", $data["content"]);
        $this->db->bindValue(":status", $data["status"]);
        $this->db->bindValue(":plan_start_date", $data["plan_start_date"]);
        $this->db->bindValue(":actual_start_date", $data["actual_start_date"]);
        $this->db->bindValue(":plan_end_date", $data["plan_end_date"]);
        $this->db->bindValue(":actual_end_date", $data["actual_end_date"]);
        $this->db->bindValue(":comment", $data["comment"]);
        $this->db->bindValue(":create_user", $data["create_user"]);

        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        }
    }

    public function updateTask($taskId, $data) {
        try {
            $this->db->beginTransaction();

            $this->update($taskId, $data);

            $attachService = new AttachService();

            if (isset($data["delete_attach_ids"])) {
                $attachService->delete($data["delete_attach_ids"]);
            }
    
            $attachService->uploadFile($taskId, $data["upload_file"]);

            $this->db->commit();

        } catch (PDOException $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    private function update($taskId, $data) {
        $this->db->prepare("
            update tasks
               set register_user = :register_user
                  ,register_date = :register_date
                  ,assignee = :assignee
                  ,target_system = :target_system
                  ,title = :title
                  ,content = :content
                  ,status = :status
                  ,plan_start_date = :plan_start_date
                  ,actual_start_date = :actual_start_date
                  ,plan_end_date = :plan_end_date
                  ,actual_end_date = :actual_end_date
                  ,comment = :comment
                  ,update_user = :update_user
                  ,update_date = current_timestamp
             where task_id = :task_id
        ");

        $this->db->bindValue(":register_user", $data["register_user"]);
        $this->db->bindValue(":register_date", $data["register_date"]);
        $this->db->bindValue(":assignee", $data["assignee"]);
        $this->db->bindValue(":target_system", $data["target_system"]);
        $this->db->bindValue(":title", $data["title"]);
        $this->db->bindValue(":content", $data["content"]);
        $this->db->bindValue(":status", $data["status"]);
        $this->db->bindValue(":plan_start_date", $data["plan_start_date"]);
        $this->db->bindValue(":actual_start_date", $data["actual_start_date"]);
        $this->db->bindValue(":plan_end_date", $data["plan_end_date"]);
        $this->db->bindValue(":actual_end_date", $data["actual_end_date"]);
        $this->db->bindValue(":comment", $data["comment"]);
        $this->db->bindValue(":update_user", $data["update_user"]);
        $this->db->bindValue(":task_id", $taskId);

        return $this->db->execute();
    }

    public function delete($taskId) {
        $this->db->prepare("
            delete
              from tasks
             where task_id = :task_id
        ");

        $this->db->bindValue(":task_id", $taskId);

        return $this->db->execute();
    }
}
