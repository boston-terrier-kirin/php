<?php
require "includes/db.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
$article = getArticle($conn, $id);

function getArticle($conn, $id) {
    if (!is_numeric($id)) {
        return null;
    }

    $sql = "select *
            from article
            where id = $id
            order by published_at;";

    $results = mysqli_query($conn, $sql);

    if ($results === false) {
        echo mysqli_error($conn);
    } else {
        $article = mysqli_fetch_assoc($results);
    }

    return $article;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My blog</title>
    <meta charset="utf-8">
</head>
<body>
    <header>
        <h1>My blog</h1>
    </header>
    <main>
        <?php if ($article === null): ?>
            <p>Article not found.</p>
        <?php else: ?>
            <ul>
                <li>
                    <article>
                        <h2><?= $article['title']; ?></h2>
                        <p><?= $article['content']; ?></p>
                    </article>
                </li>
            </ul>

        <?php endif; ?>
    </main>
</body>
</html>
