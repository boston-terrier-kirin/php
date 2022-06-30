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
  
    $errors = Article::validate($title, $content, $publishedAt);
    $error = $_FILES["upload_file"]["error"];
    if ($error == UPLOAD_ERR_NO_FILE) {
        $errors[] = "No images.";
    }

    if (empty($errors)) {
        $db = new Database();
        $conn = $db->getConnection();
        $id = Article::insert($conn, $title, $content, $publishedAt);

        $destinationDir = __dir__ . "/uploads/$id/";
        if (!file_exists($destinationDir)) {
            mkdir($destinationDir);
        }

        $fileCount = count($_FILES["upload_file"]["name"]);

        if ($_FILES["upload_file"]["name"][0] != "") {
            for ($i = 0; $i < $fileCount; $i ++) {
                $destination = $destinationDir . $_FILES["upload_file"]["name"][$i];
                $tmpName = $_FILES["upload_file"]["tmp_name"][$i];
                move_uploaded_file($tmpName, $destination);
        
                ArticleImage::insertImage($conn, $id, $_FILES["upload_file"]["name"][$i]);
            }
        }

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