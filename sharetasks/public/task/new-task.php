<?php
require_once("../bootstrap.php");

Auth::requireLogin();

$errors = [];
$data = [
    "task_id" => "",
    "register_user" => Auth::getUser(),
    "register_date" => date("Y-m-d"),
    "assignee" => "",
    "target_system" => "",
    "title" => "",
    "content" => "",
    "status" => "",
    "plan_start_date" => "",
    "actual_start_date" => "",
    "plan_end_date" => "",
    "actual_end_date" => "",
    "comment" => "",
];
$mode = "new";

if (isset($_POST["save"])) {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // $data = [
    //     "register_user" => $_POST["register_user"],
    //     "register_date" => $_POST["register_date"],
    //     "assignee" => $_POST["assignee"],
    //     "target_system" => $_POST["target_system"],
    //     "title" => $_POST["title"],
    //     "content" => $_POST["content"],
    //     "status" => $_POST["status"],
    //     "plan_start_date" => $_POST["plan_start_date"],
    //     "actual_start_date" => $_POST["actual_start_date"],
    //     "plan_end_date" => $_POST["plan_end_date"],
    //     "actual_end_date" => $_POST["actual_end_date"],
    //     "comment" => $_POST["comment"],
    //     "uploadFile" => $_FILES["upload_file"],
    // ];

    foreach($_POST as $key => $value) { 
        $data[$key] = $value;
    }
    $data["upload_file"] = $_FILES["upload_file"];

    // TODO: 入力チェック

    $taskService = new TaskService();
    $taskId = $taskService->insert($data);
   
    $attachService = new AttachService();
    $attachService->uploadFile($taskId, $data["upload_file"]);

    Util::registerMessage("task_added", "新しいタスクを追加しました。");
    Util::redirect("/task/home");
}
?>

<?php require_once APPROOT . "/includes/shared/header.php"; ?>
   
<div class="container">
    <?php require_once APPROOT . "/includes/shared/global-error.php"; ?>
    <div class="card">
        <div class="card-header">タスク新規作成</div>
        <div class="card-body">
            <?php require_once APPROOT . "/includes/task/task-form.php"; ?>
        </card>
    </div>
</div>

<?php require_once APPROOT . "/includes/shared/script.php"; ?>
<?php require_once APPROOT . "/includes/shared/footer.php"; ?>