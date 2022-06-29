<?php
require "includes/db.php";
require "includes/article.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
$conn = getConnection();
$article = getArticle($conn, $id);
?>

<?php require("includes/header.php"); ?>

<div class="container">
    <header>
        <h1>My blog</h1>
    </header>

    <?php if ($article === null): ?>
        <p>Article not found.</p>
    <?php else: ?>

        <div class="mb-3">
            <a class="btn btn-secondary" href="index.php">Back</a>
            <a class="btn btn-primary" href="edit-article.php?id=<?= $id ?>">Edit</a>
            <form action="delete-article.php" method="post" class="d-inline">
                <input type="hidden" name="id" value="<?= $id ?>" />
                <button class="btn btn-danger" name="delete">Delete</button>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                Published at: <?= htmlspecialchars($article['published_at']); ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($article['title']); ?></h5>
                <p class="card-text"><?= htmlspecialchars($article['content']); ?></p>
            </div>
        </div>     
    <?php endif; ?>
</div>

<?php require("includes/footer.php"); ?>