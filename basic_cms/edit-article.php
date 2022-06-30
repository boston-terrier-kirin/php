<?php
require "classes/Database.php";
require "classes/Auth.php";
require "classes/Util.php";
require "classes/Article.php";
require "classes/ArticleImage.php";

session_start();
Auth::requireLogin();

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
    $db = new Database();
    $conn = $db->getConnection();
    $article = Article::getById($conn, $id);
    $images = ArticleImage::getImagesByArticleId($conn, $id);
    
    $title = $article["title"];
    $content = $article["content"];
    $publishedAt = $article["published_at"];
}

if (isset($_POST["save"])) { 
    $title = $_POST["title"];
    $content = $_POST["content"];
    $publishedAt = $_POST["published_at"];
    $publishedAt = Util::convertDateTimeToDbFormat($publishedAt);
    $deleteImage = $_POST["deleteImage"];

    // TODO: 入力チェックエラーになって再表示する場合に、$imagesがなくてエラーになる。仕方がないので再取得。
    $db = new Database();
    $conn = $db->getConnection();
    $images = ArticleImage::getImagesByArticleId($conn, $id);

    $errors = Article::validate($title, $content, $publishedAt);

    if (empty($errors)) {
        $db = new Database();
        $conn = $db->getConnection();
        Article::update($conn, $id, $title, $content, $publishedAt);
        Util::redirect("/article.php?id=$id");
    }
}
?>

<?php require("includes/header.php"); ?>

<div class="container">
    <?php require("includes/error.php"); ?>
    <div class="card">
        <div class="card-header">Edit Article</div>
        <div class="card-body">
            <?php require("includes/article-form.php"); ?>
        </card>
    </div>
</div>

<?php require("includes/footer.php"); ?>