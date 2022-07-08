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

    public function insert($data) {
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

    public function getAll() {
        $this->db->prepare("
            select *
              from tasks
             order by register_date desc
        ");

        $this->db->execute();

        return $this->db->fetchAll();
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

    public function update($taskId, $data) {
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

    // public static function validate($title, $content, $publishedAt) {
    //     $errors = [];
    
    //     if ($title == "") {
    //         $errors["title"] = "Title is required";
    //     }
    
    //     if ($content == "") {
    //         $errors["content"] = "Content is required";
    //     }
    
    //     if ($publishedAt != "") {
    //         // TODO: date_create_from_format と date のどっちが正解か不明。
    //         // 2022/2/30のケースを考慮して要検討。
    //         // $datetime = date_create_from_format("Y-m-d H:i", strtotime($publishedAt));
    
    //         $datetime = date("Y-m-d H:i:s", strtotime($publishedAt));
    
    //         if (!$datetime) {
    //             $errors[] = "Invalid date and time(1)";
    //         } else {
    //             // 2022/2/30 の場合をチェック
    //             $date_errors = date_get_last_errors();
    //             if ($date_errors && $date_errors["warning_count"] > 0) {
    //                 $errors["published_at"] = "Invalid date and time(2)";
    //             }
    //         }
    //     }
    
    //     return $errors;
    // }
}
