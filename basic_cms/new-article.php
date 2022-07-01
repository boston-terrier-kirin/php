<?php
require "classes/Database.php";
require "classes/Auth.php";
require "classes/Util.php";
require "classes/Article.php";
require "classes/ArticleImage.php";

session_start();
Auth::requireLogin();

$errors = [];
$title = "";
$content = "";
$publishedAt = "";
$mode = "new";

if (isset($_POST["save"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $publishedAt = $_POST["published_at"];
    $publishedAt = Util::convertDateTimeToDbFormat($publishedAt);
    $uploadFile = $_FILES["upload_file"];
  
    $errors = Article::validate($title, $content, $publishedAt);
    $error = $_FILES["upload_file"]["error"];
    if ($error == UPLOAD_ERR_NO_FILE) {
        $errors[] = "No images.";
    }

    if (empty($errors)) {
        $db = new Database();
        $conn = $db->getConnection();
        $id = Article::insert($conn, $title, $content, $publishedAt);
        ArticleImage::uploadImage($conn, $id, $uploadFile);

        Util::redirect("/article.php?id=$id");
    }
}
?>

<?php require("includes/header.php"); ?>
   
<div class="container">
    <?php require("includes/error.php"); ?>
    <div class="card">
        <div class="card-header">New Article</div>
        <div class="card-body">
            <?php require("includes/article-form.php"); ?>
        </card>
    </div>
</div>

<?php require("includes/footer.php"); ?>