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
        <button id="xhr" class="btn btn-primary">Run XHR</button>
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

<!-- ロードのタイミングでxhrしてCookieが送られるかのテスト。 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script>
    // jquery
    $(function() {
        $.ajax("http://localhost:8090/basic_cms/api.php")
            .done(function(data){
                const user = JSON.parse(data);
                console.log("jquery", user);
            });
    });

    $("#xhr").on("click", function() {
        $.ajax("http://localhost:8090/basic_cms/api.php")
            .done(function(data){
                const user = JSON.parse(data);
                console.log("jquery", user);
            });
    });

    // axios
    async function getUsers() {
        const response = await axios.get('http://localhost:8090/basic_cms/api.php');
        console.log("axios: ", response.data);
    }
    getUsers();
</script>

<?php require("includes/footer.php"); ?>
