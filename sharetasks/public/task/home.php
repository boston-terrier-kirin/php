<?php
require_once("../bootstrap.php");

Auth::requireLogin();

if (isset($_GET["download_excel"])) {
    $filePath = UPLOAD_FOLDER . "/94/abhishek-tiwari-QOR1p5aaFMQ-unsplash.jpg";

    $media_type = (new finfo())->file($filePath, FILEINFO_MIME_TYPE) ?? 'application/octet-stream';
    
    header('Content-Type: ' . $media_type);
    header('X-Content-Type-Options: nosniff');
    header('Content-Length: ' . filesize($filePath));
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    
    while (ob_get_level()) ob_end_clean();
    readfile($filePath);
    
    exit;
}
?>

<?php require_once APPROOT . "/includes/shared/header.php"; ?>

<div class="container">
    <?php require_once APPROOT . "/includes/shared/message.php"; ?>
    <div class="mb-3">
        <a class="btn btn-primary" href="<?= URLROOT ?>/task/new-task">
            <i class="bi bi-pencil"></i> 新しいタスク
        </a>
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#searchModal">
            <i class="bi bi-search"></i> 検索条件設定
        </button>
    </div>
    <div id="task-table"></div>
</div>

<div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">検索条件設定</h5>
            </div>
            <div class="modal-body">
                <form method="get">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">ステータス:</label>
                        <input type="text" class="form-control" name="status" id="status">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button id="download_excel" name="download_excel" data-bs-dismiss="modal" class="btn btn-success">Excelダウンロード</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
            </div>
        </div>
  </div>
</div>

<?php require_once APPROOT . "/includes/shared/script.php"; ?>

<script>

    function formatTaskId(cell, formatterParams){
        const value = cell.getValue();
        return "<a href='<?= URLROOT ?>/task/edit-task?task_id=" + value +  "'>" + value + "</a>";
    }
    
    function formatStatus(cell, formatterParams){
        const value = cell.getValue();
        if (!value) {
            return "";
        }

        if (value === "plan") {
            return "<span class='badge bg-secondary'>" + value + "</span>";
        }
        if (value === "ongoing") {
            return "<span class='badge bg-primary'>" + value + "</span>";
        }
        if (value === "complete") {
            return "<span class='badge bg-success'>" + value + "</span>";
        }
    }

    const table = new Tabulator("#task-table", {
        height: window.innerHeight - 150,
        ajaxURL: "<?= URLROOT ?>/api/task",
        pagination:true,
        paginationMode:"remote",
        paginationSize:25,
        layoutColumnsOnNewData: true,
        columnHeaderVertAlign: "bottom",
        selectable:true,
        columns: [
            {
                title: "基本情報", cssClass: "bg-color1",
                columns :[
                    { title : "タスクID", field: "task_id", cssClass: "bg-color1", formatter: formatTaskId },
                    { title : "登録者", field: "register_user", cssClass: "bg-color1" },
                    { title : "登録日", field: "register_date", cssClass: "bg-color1" },
                    { title : "担当者", field: "assignee", cssClass: "bg-color1" },
                ]
            },
            {
                title: "作業内容", cssClass: "bg-color2",
                columns: [
                    { title : "対象システム", field: "target_system", cssClass: "bg-color2" },
                    { title : "タイトル", field: "title", cssClass: "bg-color2" },
                    { title : "内容", field: "content", width:250, cssClass: "bg-color2"},
                ]
            },
            {
                title: "進捗状況", cssClass: "bg-color3",
                columns: [
                    { title : "ステータス", field: "status", cssClass: "bg-color3", formatter: formatStatus },
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
