<?php
require "includes/db.php";
require "includes/auth.php";

session_start();

$sql = "SELECT *
        FROM article
        ORDER BY published_at;";

$conn = getConnection();
$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
}
?>

<?php require("includes/header.php"); ?>

<div class="container">
    <header>
        <h1>My blog</h1>
    </header>

    <?php if (isLoggedIn()): ?>
        <p>You are logged in. <a class="btn btn-secondary" href="logout.php">Log out</a></p>
    <?php else: ?>
        <p>You are not logged in. <a class="btn btn-secondary" href="login.php">Log in</a></p>
    <?php endif; ?>

    <?php if (empty($articles)): ?>
        <p>No articles found.</p>
    <?php else: ?>

        <?php if (isLoggedIn()): ?>
            <a class="btn btn-primary" href="new-article.php">New Article</a>
        <?php endif; ?>

        <ul>
            <?php foreach ($articles as $article): ?>
                <li>
                    <article>
                        <h2><a href="article.php?id=<?= $article['id']; ?>"><?= htmlspecialchars($article['title']); ?></a></h2>
                        <p><?= htmlspecialchars($article['content']); ?></p>
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>
</div>

<?php require("includes/header.php"); ?>
