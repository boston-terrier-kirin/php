<?php
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "php_rest";

$dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
$pdo = new PDO($dsn , $user, $password);

// https://www.php.net/manual/ja/pdostatement.fetch.php

// デフォルトでFETCH_ASSOC
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

echo "■FETCH_ASSOC <br />";
$stmt = $pdo->query("select * from posts");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row["title"] . "<br />";
}
echo "<br />---------------<br />";

echo "■FETCH_OBJ <br />";
$stmt = $pdo->query("select * from posts");
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    echo $row->title . "<br />";
}
echo "<br />---------------<br />";

echo "■デフォルト <br />";
$stmt = $pdo->query("select * from posts");
while ($row = $stmt->fetch()) {
    echo $row["title"] . "<br />";
}
echo "<br />---------------<br />";