<?php
require_once("../bootstrap.php");

Auth::requireLogin();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

if (!Auth::isLoggedIn()) {
    // TODO: ログインしないで直接案件を指定してアクセスした場合
    Util::redirect("/login?id=$id");
}

$article = new Article();
$articleImage = new ArticleImage();

$articleById = $article->getById($id);
$imagesById = $articleImage->getImagesByArticleId($id);
?>

<?php require_once APPROOT . "/includes/shared/header.php"; ?>

<div class="container">
    <?php if ($articleById): ?>
        <?php Util::showMessage("post_added") ?>
        <?php Util::showMessage("post_edited") ?>
        <div class="mb-3">
            <a class="btn btn-secondary" href="<?= URLROOT ?>/article/home">
                <i class="bi bi-arrow-return-left"></i> Back
            </a>
            <a class="btn btn-primary" href="<?= URLROOT ?>/article/edit-article?id=<?= $id ?>">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <form action="<?= URLROOT ?>/article/delete-article" method="post" class="d-inline">
                <input type="hidden" name="id" value="<?= $id ?>" />
                <button class="btn btn-danger" name="delete"><i class="bi bi-trash"></i> Delete</button>
            </form>
        </div>
        <div class="card">
            <div class="card-header">
                Published at: <?= htmlspecialchars($articleById['published_at']); ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($articleById['title']); ?></h5>
                <p class="card-text"><?= htmlspecialchars($articleById['content']); ?></p>

                <?php if (count($imagesById) > 0): ?>
                    <h5 class="card-title">Download</h5>
                    <ul class="list-group">
                        <?php foreach ($imagesById as $image): ?>
                            <li class="list-group-item">
                                <a class="link-dark" style="text-decoration: none"
                                    href="<?= URLROOT ?>/article/download?article_id=<?= $id; ?>&image_id=<?= $image["id"] ?>">
                                    <i class="bi bi-download"></i> <?= $image["file_name"] ?>
                                </a>
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

<?php require_once APPROOT . "/includes/shared/script.php"; ?>
<?php require_once APPROOT . "/includes/shared/footer.php"; ?>