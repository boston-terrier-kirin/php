<?php
require_once("../bootstrap.php");

Auth::requireLogin();

$taskService = new TaskService();
$tasks = $taskService->getAll();
header("Content-type: application/json;charset=utf-8");

?>

<?= json_encode($tasks); ?>