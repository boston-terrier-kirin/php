<?php
require_once("../bootstrap.php");

Auth::requireLogin();

if (isset($_GET["download_excel"])) {
    require_once APPROOT . '/lib/PHPExcel-1.8/Classes/PHPExcel.php';

    $inputFileType = 'Excel2007';
    $inputFileName = APPROOT . '/public/task/template/taskList.xlsx';

    $objPHPExcelReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objPHPExcelReader->load($inputFileName);
    
    $objSheet = $objPHPExcel->setActiveSheetIndex(0);
    $objSheet->getDefaultStyle()->getFont()->setName( 'ＭＳ ゴシック' )->setSize(9);

    $taskService = new TaskService();
    $tasks = $taskService->getAll();

    $startRowIdx = 5;
    foreach($tasks as $task) {
        foreach(TaskService::$excelColumnDef as $key => $def) {
            $objSheet->setCellValue($def["excelCol"] . $startRowIdx, $task[$key]);
        }
        $startRowIdx ++;
    }
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="taskList.xlsx"');

    // TODO: まだ実験段階 -> ダウンロード完了したらモーダルを閉じる。
    setcookie("downloadToken", "Y");

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $inputFileType);
    $objWriter->save('php://output');

    exit;
}
?>

<?php require_once APPROOT . "/includes/shared/header.php"; ?>

<div class="container">
    <?php require_once APPROOT . "/includes/shared/message.php"; ?>
    <div class="mb-3">
        <a class="btn btn-primary me-2" id="new-task" href="<?= URLROOT ?>/task/new-task">
            <i class="bi bi-pencil"></i> 新しいタスク
        </a>
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#searchModal">
            <i class="bi bi-search"></i> 検索条件設定
        </button>
    </div>
    <div id="task-table"></div>
</div>

<div class="modal fade" id="searchModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
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
                        <button id="download_excel" name="download_excel" class="btn btn-success">Excelダウンロード</button>
                        <button id="downloading_excel" class="btn btn-success d-none" type="button" disabled>
                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                          Downloading...
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="cancel" type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
            </div>
        </div>
  </div>
</div>

<?php require_once APPROOT . "/includes/shared/script.php"; ?>

<script>
    // TODO: まだ実験段階 -> ダウンロード完了したらモーダルを閉じる。
    function getCookie( name ) {
        var parts = document.cookie.split(name + "=");
        if (parts.length == 2) {
            return parts.pop().split(";").shift();
        }
    }

    // TODO: まだ実験段階 -> ダウンロード完了したらモーダルを閉じる。
    const searchModal = new bootstrap.Modal(document.getElementById('searchModal'));

    // TODO: まだ実験段階 -> ダウンロード完了したらモーダルを閉じる。
    document.getElementById("download_excel").addEventListener("click", function() {
        const download = document.getElementById("download_excel");
        const downloading = document.getElementById("downloading_excel");
        const cancel = document.getElementById("cancel");

        download.classList.add("d-none");
        downloading.classList.remove("d-none");
        cancel.disabled = true;

        trial = 10;

        downloadTimer = window.setInterval( function() {
            const token = getCookie( "downloadToken" );
            if(token == "Y" || trial == 0) {
                searchModal.hide();
                
                download.classList.remove("d-none");
                downloading.classList.add("d-none");
                cancel.disabled = false;
                
                document.cookie = "downloadToken=; max-age=0";

                window.clearInterval( downloadTimer );
            }
            trial --;
        }, 1000 );
    });

    function formatTaskId(cell, formatterParams){
        const value = cell.getValue();
        return "<a href='<?= URLROOT ?>/task/edit-task?task_id=" + value +  "'>" + value + "</a>";
    }
    
    function formatStatus(cell, formatterParams){
        const value = cell.getValue();
        if (!value) {
            return "";
        }

        if (value === "予定") {
            return "<span class='badge bg-secondary'>" + value + "</span>";
        }
        if (value === "進行中") {
            return "<span class='badge bg-primary'>" + value + "</span>";
        }
        if (value === "完了") {
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
                title: "作業情報", cssClass: "bg-color2",
                columns: [
                    { title : "対象システム", field: "target_system", cssClass: "bg-color2" },
                    { title : "タイトル", field: "title", cssClass: "bg-color2" },
                    { title : "内容", field: "content", width:250, cssClass: "bg-color2"},
                ]
            },
            {
                title: "進捗情報", cssClass: "bg-color3",
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
