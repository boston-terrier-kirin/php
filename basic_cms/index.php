<?php
require "classes/Database.php";
require "classes/Auth.php";
require "classes/Util.php";
require "classes/Article.php";

session_start();
Auth::requireLogin();

$db = new Database();
$conn = $db->getConnection();
$articles = Article::getAll($conn);
?>

<?php require("includes/header.php"); ?>

<div class="container">
    <div class="mb-3">
        <a class="btn btn-primary" href="new-article.php">
            <i class="bi bi-pencil"></i> New Article
        </a>
    </div>
    <?php if (empty($articles)): ?>
        <p>No articles found.</p>
    <?php else: ?>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Published At</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td class="text-center"><?= htmlspecialchars($article['id']); ?></td>
                        <td><?= htmlspecialchars($article['title']); ?></td>
                        <td><?= htmlspecialchars($article['published_at']); ?></td>
                        <td><a class="btn btn-success btn-sm" href="article.php?id=<?= $article['id']; ?>"><i class="bi bi-book"></i> Read Now</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require("includes/footer.php"); ?>
