<?php
require_once("../bootstrap.php");

Auth::requireLogin();

$method = $_SERVER["REQUEST_METHOD"];
$errors = [];
$data = [];
$mode = "edit";

if (isset($_GET["task_id"])) {
    $taskId = $_GET["task_id"];
}

if ($method == "GET") {
    $taskService = new TaskService();
    $data = $taskService->getById($taskId);

    $attachService = new AttachService();
    $attaches = $attachService->getByTaskId($taskId);
    $data["attaches"] = $attaches;
}

if (isset($_POST["save"])) { 

    foreach($_POST as $key => $value) { 
        $data[$key] = $value;
    }
    $data["upload_file"] = $_FILES["upload_file"];

    // TODO: 入力チェックエラーになって再表示する場合に、$attachesがなくてエラーになる。仕方がないので再取得。
    $attachService = new AttachService();
    $attaches = $attachService->getByTaskId($taskId);
    $data["attaches"] = $attaches;

    // TODO: 入力チェック
    $taskService = new TaskService();
    $taskService->update($taskId, $data);

    if (isset($data["delete_attach_ids"])) {
        $attachService->delete($data["delete_attach_ids"]);
    }

    $attachService->uploadFile($taskId, $data["upload_file"]);

    Util::registerMessage("task_edited", "タスクを更新しました。");
    Util::redirect("/task/home");
}

if (isset($_POST["delete"])) {
    $taskId = $_POST["task_id"];

    $taskService = new TaskService();
    $taskService->delete($taskId);

    Util::registerMessage("task_edited", "タスクを削除しました。");
    Util::redirect("/task/home");
} 
?>

<?php require_once APPROOT . "/includes/shared/header.php"; ?>

<div class="container">
    <?php require_once APPROOT . "/includes/shared/global-error.php"; ?>
    <div class="card">
        <div class="card-header">Edit Article</div>
        <div class="card-body">
            <?php require_once APPROOT . "/includes/task/task-form.php"; ?>
        </card>
    </div>
</div>

<?php require_once APPROOT . "/includes/shared/script.php"; ?>
<?php require_once APPROOT . "/includes/shared/footer.php"; ?>