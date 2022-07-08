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
        <button id="xhr" class="btn btn-primary">Run XHR</button>
    </div>
    <?php if (!empty($tasks)): ?>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>タスクID</th>
                    <th>登録者</th>
                    <th>登録日</th>
                    <th>担当者</th>
                    <th>対象システム</th>
                    <th>タイトル</th>
                    <th>内容</th>
                    <th>ステータス</th>
                    <th>開始予定日</th>
                    <th>開始日</th>
                    <th>終了予定日</th>
                    <th>終了日</th>
                    <th>コメント</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td class="text-center">
                            <a href="<?= URLROOT ?>/task/edit-task?task_id=<?= $task['task_id']; ?>">    
                                <?= htmlspecialchars($task['task_id']); ?>
                            </a>
                        </td>
                        <td><?= htmlspecialchars($task['register_user']); ?></td>
                        <td><?= htmlspecialchars($task['register_date']); ?></td>
                        <td><?= htmlspecialchars($task['assignee']); ?></td>
                        <td><?= htmlspecialchars($task['target_system']); ?></td>
                        <td><?= htmlspecialchars($task['title']); ?></td>
                        <td><?= htmlspecialchars($task['content']); ?></td>
                        <td><?= htmlspecialchars($task['status']); ?></td>
                        <td><?= htmlspecialchars($task['plan_start_date']); ?></td>
                        <td><?= htmlspecialchars($task['actual_start_date']); ?></td>
                        <td><?= htmlspecialchars($task['plan_end_date']); ?></td>
                        <td><?= htmlspecialchars($task['actual_end_date']); ?></td>
                        <td><?= htmlspecialchars($task['comment']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once APPROOT . "/includes/shared/script.php"; ?>

<!-- ロードのタイミングでxhrしてCookieが送られるかのテスト。 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script>
    // jquery
    $(function() {
        $.ajax("http://localhost:8090/basic_cms_v2/api/api.php")
            .done(function(data){
                const user = JSON.parse(data);
                console.log("jquery", user);
            });
    });

    $("#xhr").on("click", function() {
        $.ajax("http://localhost:8090/basic_cms_v2/api/api.php")
            .done(function(data){
                const user = JSON.parse(data);
                console.log("jquery", user);
            });
    });

    // axios
    async function getUsers() {
        const response = await axios.get('http://localhost:8090/basic_cms_v2/api/api.php');
        console.log("axios: ", response.data);
    }
    getUsers();
</script>

<?php require_once APPROOT . "/includes/shared/footer.php"; ?>
