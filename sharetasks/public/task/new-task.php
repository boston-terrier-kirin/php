<?php
require_once("../bootstrap.php");

Auth::requireLogin();

$errors = [];
$data = [];
foreach(TaskService::$columnDef as $key => $def) {
    $data[$key] = $def["initValue"];
}
$data["register_user"] = Auth::getUser();
$data["register_date"] = date("Y-m-d");
$data["create_user"] = Auth::getUser();
$mode = "new";

if (isset($_POST["save"])) {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    foreach($_POST as $key => $value) {
        if (isset($data[$key])) {
            $data[$key] = $value;
        } 
    }
    $data["upload_file"] = $_FILES["upload_file"];

    $taskService = new TaskService();
    $errors = $taskService->validate($data);

    if (empty($errors)) {
        $taskService->createTask($data);
   
        Util::registerMessage("新しいタスクを追加しました。");
        Util::redirect("/task/home");
    } else {
        Util::registerErrorMessage("入力内容を見直してください。");
        if (AttachService::fileAttached($data["upload_file"])) {
            Util::registerErrorMessage("添付ファイルは再選択が必要です。ご注意ください。");
        }
    }
}
?>

<?php require_once APPROOT . "/includes/shared/header.php"; ?>
   
<div class="container">
    <?php require_once APPROOT . "/includes/shared/message.php"; ?>
    <div class="card mb-3">
        <div class="card-header">タスクの新規作成</div>
        <div class="card-body">
            <?php require_once APPROOT . "/includes/task/task-form.php"; ?>
        </card>
    </div>
</div>

<?php require_once APPROOT . "/includes/shared/script.php"; ?>
<?php require_once APPROOT . "/includes/shared/footer.php"; ?>