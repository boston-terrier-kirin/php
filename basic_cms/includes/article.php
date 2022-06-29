<?php
function getArticle($conn, $id) {
    if (!is_numeric($id)) {
        return null;
    }

    $sql = "select *
              from article
             where id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
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