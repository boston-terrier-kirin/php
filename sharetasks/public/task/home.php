<?php
require_once("../bootstrap.php");

Auth::requireLogin();

$taskService = new TaskService();
$tasks = $taskService->getAll();
?>

<?php require_once APPROOT . "/includes/shared/header.php"; ?>

<div class="container">
    <?php Util::showMessage("welcome") ?>
    <?php Util::showMessage("task_added") ?>
    <?php Util::showMessage("task_edited") ?>
    <?php Util::showMessage("task_deleted") ?>
    <div class="mb-3">
        <a class="btn btn-primary" href="<?= URLROOT ?>/task/new-task">
            <i class="bi bi-pencil"></i> 新しいタスク
        </a>
    </div>
    <div id="task-table"></div>
</div>

<?php require_once APPROOT . "/includes/shared/script.php"; ?>

<script>
    function linkFormatter(cell, formatterParams){
        const value = cell.getValue();
        return "<a href='<?= URLROOT ?>/task/edit-task?task_id=" + value +  "'>" + value + "</a>";
    }

    const table = new Tabulator("#task-table", {
        height: window.innerHeight - 150,
        ajaxURL: "<?= URLROOT ?>/api/task",
        layoutColumnsOnNewData: true,
        columnHeaderVertAlign: "bottom",
        columns: [
            { title: "基本情報", cssClass: "bg-color1",
                columns :[
                    { title : "タスクID", field: "task_id", cssClass: "bg-color1", formatter: linkFormatter },
                    { title : "登録者", field: "register_user", cssClass: "bg-color1" },
                    { title : "登録日", field: "register_date", cssClass: "bg-color1" },
                    { title : "担当者", field: "assignee", cssClass: "bg-color1" },
                ]
            },
            { title: "作業内容", cssClass: "bg-color2",
                columns: [
                    { title : "対象システム", field: "target_system", cssClass: "bg-color2" },
                    { title : "タイトル", field: "title", cssClass: "bg-color2" },
                    { title : "内容", field: "content", width:250, cssClass: "bg-color2"},
                ]
            },
            { title: "進捗状況", cssClass: "bg-color3",
                columns: [
                    { title : "ステータス", field: "status", cssClass: "bg-color3" },
                    { title : "開始予定日", field: "plan_start_date", cssClass: "bg-color3" },
                    { title : "終了予定日", field: "plan_end_date", cssClass: "bg-color3" },
                    { title : "開始日", field: "actual_start_date", cssClass: "bg-color3" },
                    { title : "終了日", field: "actual_end_date", cssClass: "bg-color3" },
                ]
            },
            { title : "コメント", field: "comment", cssClass: "bg-color1" },
            { title : "作成者", field: "create_user", cssClass: "bg-color1" },
            { title : "作成日", field: "create_date", cssClass: "bg-color1" },
            { title : "更新者", field: "update_user", cssClass: "bg-color1" },
            { title : "更新日", field: "update_date", cssClass: "bg-color1" },
        ]
    });
</script>

<?php require_once APPROOT . "/includes/shared/footer.php"; ?>
