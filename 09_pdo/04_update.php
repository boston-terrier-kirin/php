<?php
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "php_rest";

$dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
$pdo = new PDO($dsn , $user, $password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$id = 11;
$title = "Test Post - UPDATED";

$sql = "update posts set title = :title where id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue("id", $id);
$stmt->bindValue("title", $title);
$stmt->execute();
