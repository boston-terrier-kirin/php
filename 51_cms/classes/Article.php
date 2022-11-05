<?php
class Article {
    public static function insert($conn, $title, $content, $publishedAt) {
        $sql = "insert into article(title, content, published_at)
                values(:title, :content, :published_at);";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":content", $content, PDO::PARAM_STR);

        if ($publishedAt == "") {
            $stmt->bindValue(":published_at", $publishedAt, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(":published_at", $publishedAt, PDO::PARAM_STR);
        }

        if ($stmt->execute()) {
            return $conn->lastInsertId();
        }
    }

    public static function getAll($conn) {
        $sql = "select *
                  from article
                 order by published_at;";

        $results = $conn->query($sql);
        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($conn, $id) {
        if (!is_numeric($id)) {
            return null;
        }
    
        $sql = "select *
                  from article
                 where id = :id";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    public static function update($conn, $id, $title, $content, $publishedAt) {
        $sql = "update article
                   set title = :title
                      ,content = :content
                      ,published_at = :published_at
                 where id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":content", $content, PDO::PARAM_STR);

        if ($publishedAt == "") {
            $stmt->bindValue(":published_at", $publishedAt, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(":published_at", $publishedAt, PDO::PARAM_STR);
        }

        return $stmt->execute();
    }

    public static function delete($conn, $id) {
        $sql = "delete
                  from article
                 where id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public static function validate($title, $content, $publishedAt) {
        $errors = [];
    
        if ($title == "") {
            $errors[] = "Title is required";
        }
    
        if ($content == "") {
            $errors[] = "Content is required";
        }
    
        if ($publishedAt != "") {
            // TODO: date_create_from_format と date のどっちが正解か不明。
            // 2022/2/30のケースを考慮して要検討。
            // $datetime = date_create_from_format("Y-m-d H:i", strtotime($publishedAt));
    
            $datetime = date("Y-m-d H:i:s", strtotime($publishedAt));
    
            if (!$datetime) {
                $errors[] = "Invalid date and time(1)";
            } else {
                // 2022/2/30 の場合をチェック
                $date_errors = date_get_last_errors();
                if ($date_errors && $date_errors["warning_count"] > 0) {
                    $errors[] = "Invalid date and time(2)";
                }
            }
        }
    
        return $errors;
    }
}
?>