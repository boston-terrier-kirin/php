<?php
function getArticle($conn, $id) {
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

function validateArticle($title, $content, $publishedAt) {
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
?>