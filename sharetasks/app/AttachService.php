<?php
class AttachService {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function uploadFile($taskId, $files) {
        $fileCount = count($files["name"]);

        if ($files["name"][0] != "") {
            $destinationDir = UPLOAD_FOLDER . "/$taskId/";
            if (!file_exists($destinationDir)) {
                mkdir($destinationDir);
            }

            for ($i = 0; $i < $fileCount; $i ++) {
                $destination = $destinationDir . $files["name"][$i];
                $tmpName = $files["tmp_name"][$i];
                move_uploaded_file($tmpName, $destination);
        
                $this->insert($taskId, $files["name"][$i]);
            }
        }
    }

    private function insert($taskId, $fileName) {
        $this->db->prepare("
            insert into attach_files(task_id, file_name)
            values(:task_id, :file_name)
        ");

        $this->db->bindValue(":task_id", $taskId);
        $this->db->bindValue(":file_name", $fileName);
        $this->db->execute();
    }

    public function delete($attachIds) {
        $this->db->prepare("
            delete from attach_files
             where attach_id = :attach_id
        ");

        foreach($attachIds as $attachId) {
            $this->db->bindValue(":attach_id", $attachId);
            $this->db->execute();
        }
    }

    public function getByAttachId($attachId) {  
        $this->db->prepare("
            select *
              from attach_files
             where attach_id = :attach_id
        ");

        $this->db->bindValue(":attach_id", $attachId);
        $this->db->execute();

        return $this->db->fetch();
    }

    public function getByTaskId($taskId) {  
        $this->db->prepare("
            select *
              from attach_files
             where task_id = :task_id
        ");

        $this->db->bindValue(":task_id", $taskId);
        $this->db->execute();

        return $this->db->fetchAll();
    }
}
