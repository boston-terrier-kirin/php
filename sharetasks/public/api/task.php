<?php
require_once("../bootstrap.php");

Auth::requireLogin();

$page = 1;
$size = 25;

if (isset($_GET["page"])) {
    $page = $_GET["page"];
}

if (isset($_GET["size"])) {
    $size = $_GET["size"];
}

$offset = ($page - 1) * $size;
if ($page == 1) {
    $offset = 0;
}

$taskService = new TaskService();
$count = $taskService->count();
$tasks = $taskService->getTasks($offset, $size);
$pageSize = ceil($count["cnt"] / $size);

$res["last_page"] = $pageSize;
$res["data"] = $tasks;

header("Content-type: application/json;charset=utf-8");
?>

<?= json_encode($res); ?>