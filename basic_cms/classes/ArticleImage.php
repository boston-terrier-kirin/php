<?php
class ArticleImage {

    public static function uploadImage($conn, $id, $files) {
        $fileCount = count($files["name"]);

        if ($files["name"][0] != "") {
            // TODO: __dir__ はこのファイルのディレクトリになるので、ファイルの場所に依存してしまう。
            $destinationDir = dirname(__dir__) . "/uploads/$id/";
            if (!file_exists($destinationDir)) {
                mkdir($destinationDir);
            }

            for ($i = 0; $i < $fileCount; $i ++) {
                $destination = $destinationDir . $files["name"][$i];
                $tmpName = $files["tmp_name"][$i];
                move_uploaded_file($tmpName, $destination);
        
                ArticleImage::insertImage($conn, $id, $files["name"][$i]);
            }
        }
    }

    public static function insertImage($conn, $articleId, $fileName) {
        $sql = "insert into image_file(article_id, file_name)
                values(:article_id, :file_name);";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":article_id", $articleId, PDO::PARAM_STR);
        $stmt->bindValue(":file_name", $fileName, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function deleteImage($conn, $ids) {
        $sql = "delete from image_file
                 where id = :id;";

        foreach($ids as $id) {
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public static function getImageById($conn, $id) {  
        $sql = "select *
                  from image_file
                 where id = :id";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    public static function getImagesByArticleId($conn, $articleId) {  
        $sql = "select *
                  from image_file
                 where article_id = :article_id";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":article_id", $articleId, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}
?>