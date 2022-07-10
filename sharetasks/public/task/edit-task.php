<?php
require_once("../bootstrap.php");

Auth::requireLogin();

$method = $_SERVER["REQUEST_METHOD"];
$errors = [];
$data = [];
foreach(TaskService::$columnDef as $key => $def) {
    $data[$key] = $def["initValue"];
}
$data["update_user"] = Auth::getUser();
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
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    foreach($_POST as $key => $value) {
        if (isset($data[$key])) {
            $data[$key] = $value;
        } 
    }
    $data["upload_file"] = $_FILES["upload_file"];
    if (isset($_POST["delete_attach_ids"])) {
        $data["delete_attach_ids"] = $_POST["delete_attach_ids"];
    }

    $attachService = new AttachService();
    $attaches = $attachService->getByTaskId($taskId);
    $data["attaches"] = $attaches;

    $taskService = new TaskService();
    $errors = $taskService->validate($data);

    if (empty($errors)) {
        $taskService->updateTask($taskId, $data);

        Util::registerMessage("タスクを更新しました。");
        Util::redirect("/task/home");
    } else {
        Util::registerErrorMessage("入力内容を見直してください。");
        if (AttachService::fileAttached($data["upload_file"])) {
            Util::registerErrorMessage("添付ファイルは再選択が必要です。ご注意ください。");
        }
    }
}

if (isset($_POST["delete"])) {
    $taskId = $_POST["task_id"];

    $taskService = new TaskService();
    $taskService->delete($taskId);

    Util::registerMessage("タスクを削除しました。");
    Util::redirect("/task/home");
} 
?>

<?php require_once APPROOT . "/includes/shared/header.php"; ?>

<div class="container">
    <?php require_once APPROOT . "/includes/shared/message.php"; ?>
    <div class="card mb-3">
        <div class="card-header">タスクの更新</div>
        <div class="card-body">
            <?php require_once APPROOT . "/includes/task/task-form.php"; ?>
        </card>
    </div>
</div>

<?php require_once APPROOT . "/includes/shared/script.php"; ?>
<?php require_once APPROOT . "/includes/shared/footer.php"; ?>