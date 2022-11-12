<?php
// .htaccess で何が来てもindex.phpが来るようになっている、frontcontrollerパターン


// http://localhost:8090/task_api/task/1?page=1
$path = parse_url($_SERVER["REQUEST_URI"]);

// task_api/task/1
echo $path["path"];
echo "<br />-----<br />";

// page=1
echo $path["query"];
echo "<br />-----<br />";

// / で区切る
$parts = explode("/", $path["path"]);
// 空白
echo $parts[0];
echo "<br />-----<br />";
// task_api
echo $parts[1];
echo "<br />-----<br />";
// task
echo $parts[2];
echo "<br />-----<br />";
// 1
echo $parts[3];
echo "<br />-----<br />";

$resource = $parts[2];
$id = $parts[3] ?? null;

echo "resource=$resource, id=$id";
echo "<br />-----<br />";

echo $_SERVER["REQUEST_METHOD"];
