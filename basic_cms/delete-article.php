<?php
require "includes/db.php";
require "includes/util.php";
require "includes/article.php";

$id = null;

if (isset($_POST["delete"])) {
    $id = $_POST["id"];

    $sql = "delete
              from article
             where id = ?";

    $conn = getConnection();
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {          
        mysqli_stmt_bind_param($stmt,
                                "i",
                                $id);

        if (mysqli_stmt_execute($stmt)) {
            redirect("/index.php");
        } else {
            echo mysqli_stmt_error($conn);
        }
    }
}
?>