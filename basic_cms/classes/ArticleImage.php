<?php
class ArticleImage {
    public static function insertImage($conn, $articleId, $fileName) {
        $sql = "insert into image_file(article_id, file_name)
                values(:article_id, :file_name);";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":article_id", $articleId, PDO::PARAM_STR);
        $stmt->bindValue(":file_name", $fileName, PDO::PARAM_STR);
        $stmt->execute();
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