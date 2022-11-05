<?php
require "classes/Database.php";
require "classes/Auth.php";
require "classes/Util.php";
require "classes/Article.php";
require "classes/ArticleImage.php";

session_start();
Auth::requireLogin();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

if (!Auth::isLoggedIn()) {
    // TODO: ログインしないで直接案件を指定してアクセスした場合
    Util::redirect("/login.php?id=$id");
}

$db = new Database();
$conn = $db->getConnection();
$article = Article::getById($conn, $id);
$images = ArticleImage::getImagesByArticleId($conn, $id);
?>

<?php require("includes/header.php"); ?>

<div class="container">
    <?php if ($article): ?>
        <div class="mb-3">
            <a class="btn btn-secondary" href="index.php"><i class="bi bi-arrow-return-left"></i> Back</a>
            <a class="btn btn-primary" href="edit-article.php?id=<?= $id ?>"><i class="bi bi-pencil"></i> Edit</a>
            <form action="delete-article.php" method="post" class="d-inline">
                <input type="hidden" name="id" value="<?= $id ?>" />
                <button class="btn btn-danger" name="delete"><i class="bi bi-trash"></i> Delete</button>
            </form>
        </div>
        <div class="card">
            <div class="card-header">
                Published at: <?= htmlspecialchars($article['published_at']); ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($article['title']); ?></h5>
                <p class="card-text"><?= htmlspecialchars($article['content']); ?></p>

                <?php if (count($images) > 0): ?>
                    <h5 class="card-title">Download</h5>
                    <ul class="list-group">
                        <?php foreach ($images as $image): ?>
                            <li class="list-group-item">
                                <a class="link-dark" style="text-decoration: none" href="download.php?article_id=<?= $id; ?>&image_id=<?= $image["id"] ?>"><i class="bi bi-download"></i> <?= $image["file_name"] ?></a>
                            </li>    
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div> 
    <?php else: ?>
        <p>Article not found.</p>
    <?php endif; ?>
</div>

<?php require("includes/footer.php"); ?>