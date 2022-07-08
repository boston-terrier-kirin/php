<?php
class ArticleImage {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function uploadImage($id, $files) {
        $fileCount = count($files["name"]);

        if ($files["name"][0] != "") {
            // TODO: __dir__ はこのファイルのディレクトリになるので、ファイルの場所に依存してしまう。
            $destinationDir = dirname(__dir__) . "/uploads/$id/";
            if (!file_exists($destinationDir)) {
                mkdir($destinationDir);
            }

            $conn = $this->db->getConnection();
            for ($i = 0; $i < $fileCount; $i ++) {
                $destination = $destinationDir . $files["name"][$i];
                $tmpName = $files["tmp_name"][$i];
                move_uploaded_file($tmpName, $destination);
        
                $this->insertImage($conn, $id, $files["name"][$i]);
            }
        }
    }

    private function insertImage($conn, $articleId, $fileName) {
        $sql = "insert into image_file(article_id, file_name)
                values(:article_id, :file_name);";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":article_id", $articleId, PDO::PARAM_STR);
        $stmt->bindValue(":file_name", $fileName, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function deleteImage($ids) {
        $sql = "delete from image_file
                 where id = :id;";

        $conn = $this->db->getConnection();
        $stmt = $conn->prepare($sql);
        foreach($ids as $id) {
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function getImageById($id) {  
        $sql = "select *
                  from image_file
                 where id = :id";

        $conn = $this->db->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getImagesByArticleId($articleId) {  
        $sql = "select *
                  from image_file
                 where article_id = :article_id";

        $conn = $this->db->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":article_id", $articleId, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}
