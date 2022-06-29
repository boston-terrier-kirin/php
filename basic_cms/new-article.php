<?php
require "includes/db.php";
require "includes/auth.php";
require "includes/util.php";
require "includes/article.php";

session_start();
if (!isLoggedIn()) {
    redirect("/login.php");
}

$errors = [];
$title = "";
$content = "";
$publishedAt = "";
$mode = "new";

if (isset($_POST["save"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $publishedAt = $_POST["published_at"];
    $publishedAt = convertDateTimeToDbFormat($publishedAt);

    $errors = validateArticle($title, $content, $publishedAt);

    if (empty($errors)) {
        $sql = "insert into article(title, content, published_at)
                values(?, ?, ?);";

        $conn = getConnection();
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {
            if ($publishedAt == "") {
                $publishedAt = null;
            }
            
            mysqli_stmt_bind_param($stmt,
                                    "sss",
                                    $title, $content, $publishedAt);

            if (mysqli_stmt_execute($stmt)) {
                $id = mysqli_insert_id($conn);
                redirect("/article.php?id=$id");
            } else {
                echo mysqli_stmt_error($conn);
            }
        }
    }
}
?>

<?php require("includes/header.php"); ?>

<header class="container mb-3">
    <h1>My blog</h1>
</header>
    
<div class="container">
    <?php require("includes/error.php"); ?>
    <?php require("includes/article-form.php"); ?>
</div>

<?php require("includes/footer.php"); ?>