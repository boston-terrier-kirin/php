<?php
require_once("../bootstrap.php");

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
    $article = new Article();
    $articleImage = new ArticleImage();

    $articleById = $article->getById($id);
    $images = $articleImage->getImagesByArticleId($id);
    
    $title = $articleById["title"];
    $content = $articleById["content"];
    $publishedAt = $articleById["published_at"];
}

if (isset($_POST["save"])) { 
    $title = $_POST["title"];
    $content = $_POST["content"];
    $publishedAt = $_POST["published_at"];
    $publishedAt = Util::convertDateTimeToDbFormat($publishedAt);
    $uploadFile = $_FILES["upload_file"];
    if (isset($_POST["deleteImage"])) {
        $deleteImage = $_POST["deleteImage"];
    }

    // TODO: 入力チェックエラーになって再表示する場合に、$imagesがなくてエラーになる。仕方がないので再取得。
    $article = new Article();
    $articleImage = new ArticleImage();
    $images = $articleImage->getImagesByArticleId($id);

    $errors = Article::validate($title, $content, $publishedAt);

    if (empty($errors)) {
        $article->update($id, $title, $content, $publishedAt);

        if ($deleteImage) {
            $articleImage->deleteImage($deleteImage);
        }

        $articleImage->uploadImage($id, $uploadFile);

        Util::registerMessage("post_edited", "Post Edited");
        Util::redirect("/article/article?id=$id");
    }
}
?>

<?php require_once APPROOT . "/includes/shared/header.php"; ?>

<div class="container">
    <?php require_once APPROOT . "/includes/shared/global-error.php"; ?>
    <div class="card">
        <div class="card-header">Edit Article</div>
        <div class="card-body">
            <?php require_once APPROOT . "/includes/article/article-form.php"; ?>
        </card>
    </div>
</div>

<?php require_once APPROOT . "/includes/shared/script.php"; ?>
<?php require_once APPROOT . "/includes/shared/footer.php"; ?>