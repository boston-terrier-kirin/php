<?php
require_once("../bootstrap.php");

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

    if (empty($errors)) {
        $article = new Article();
        $articleImage = new ArticleImage();

        $id = $article->insert($title, $content, $publishedAt);
        $articleImage->uploadImage($id, $uploadFile);

        Util::registerMessage("post_added", "New Post Added");
        Util::redirect("/article?id=$id");
    }
}
?>

<?php require_once APPROOT . "/includes/shared/header.php"; ?>
   
<div class="container">
    <?php require_once APPROOT . "/includes/shared/global-error.php"; ?>
    <div class="card">
        <div class="card-header">New Article</div>
        <div class="card-body">
            <?php require_once APPROOT . "/includes/article/article-form.php"; ?>
        </card>
    </div>
</div>

<?php require_once APPROOT . "/includes/shared/script.php"; ?>
<?php require_once APPROOT . "/includes/shared/footer.php"; ?>