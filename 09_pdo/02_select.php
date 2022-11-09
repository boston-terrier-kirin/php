<?php
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "php_rest";

$dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
$pdo = new PDO($dsn , $user, $password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$author = "Sam Smith";

// Positional Parameter
echo "■Positional Parameter <br />";
$sql = "select * from posts where author = ?";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $author, PDO::PARAM_STR);
$stmt->execute();
$posts = $stmt->fetchAll();

foreach ($posts as $post) {
    echo $post["title"] . "<br />";
}
echo "<br />---------------<br />";

echo "row_count: " . $stmt->rowCount();
echo "<br />---------------<br />";

// Named Parameter
echo "■Named Parameter <br />";
$sql = "select * from posts where author = :author";
$stmt = $pdo->prepare($sql);
$stmt->bindValue("author", $author, PDO::PARAM_STR);
$stmt->execute();
$posts = $stmt->fetchAll();

foreach ($posts as $post) {
    echo $post["title"] . "<br />";
}
echo "<br />---------------<br />";

// 結果がゼロ件の場合
echo "■結果がゼロ件の場合 <br />";
$author = "test";
$sql = "select * from posts where author = :author";
$stmt = $pdo->prepare($sql);
$stmt->bindValue("author", $author, PDO::PARAM_STR);
$stmt->execute();
$posts = $stmt->fetchAll();
var_dump($posts);
echo "<br />---------------<br />";

// Fetch Single
echo "■Fetch Single <br />";
$id = 1;
$sql = "select * from posts where id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue("id", $id, PDO::PARAM_INT);
$stmt->execute();
$post = $stmt->fetch();
// 戻りが配列ではない
echo $post["title"] . "<br />";
echo "<br />---------------<br />";

// 結果がゼロ件の場合
echo "■結果がゼロ件の場合 <br />";
$id = 99;
$sql = "select * from posts where id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue("id", $id, PDO::PARAM_INT);
$stmt->execute();
$post = $stmt->fetch();
var_dump($post);
echo "<br />---------------<br />";
