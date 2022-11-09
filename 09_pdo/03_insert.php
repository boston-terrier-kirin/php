<?php
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "php_rest";

$dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
$pdo = new PDO($dsn , $user, $password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$title = "Test Post";
$category_id = 1;
$body = "This is test";
$author = "Brad";

$sql = "insert into posts(title, category_id, body, author, created_at) values(:title, :category_id, :body, :author, :created_at)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue("title", $title);
$stmt->bindValue("category_id", $category_id);
$stmt->bindValue("body", $body);
$stmt->bindValue("author", $author);
$stmt->bindValue("created_at", date("Y-m-d H:i:s", time()));
$stmt->execute();

echo $pdo->lastInsertId();