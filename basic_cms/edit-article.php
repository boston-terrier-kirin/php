<?php
require "includes/db.php";
require "includes/util.php";
require "includes/article.php";

$method = $_SERVER["REQUEST_METHOD"];
$errors = [];
$id = null;
$title = "";
$content = "";
$publishedAt = "";
$mode = "edit";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

if (!$id) {
    // TODO: articleが見つからなかった場合
}

if ($method == "GET") {
    $conn = getConnection();
    $article = getArticle($conn, $id);
    
    $title = $article["title"];
    $content = $article["content"];
    $publishedAt = $article["published_at"];
}

if (isset($_POST["save"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $publishedAt = $_POST["published_at"];
    $publishedAt = convertDateTimeToDbFormat($publishedAt);

    $errors = validateArticle($title, $content, $publishedAt);

    if (empty($errors)) {
        $sql = "update article
                   set title = ?
                      ,content = ?
                      ,published_at = ?
                 where id = ?";

        $conn = getConnection();
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {
            if ($publishedAt == "") {
                $publishedAt = null;
            }
            
            mysqli_stmt_bind_param($stmt,
                                    "sssi",
                                    $title, $content, $publishedAt, $id);

            if (mysqli_stmt_execute($stmt)) {
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