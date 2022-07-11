<form method="post" enctype="multipart/form-data">
    <div class="mb-3 d-flex">
        <a class="btn btn-secondary me-2" href="<?= URLROOT ?>/task/home">
            <i class="bi bi-arrow-return-left"></i> キャンセル
        </a>
        <button class="btn btn-primary me-auto" name="save">
            <i class="bi bi-save"></i> 保存
        </button>
        <?php if ($mode == "edit"): ?>
            <input type="hidden" name="task_id" value="<?= $taskId ?>" />
            <button class="btn btn-danger" name="delete"><i class="bi bi-trash"></i> 削除</button>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col-sm col-lg-6 mb-3">
            <label class="form-label" for="title">登録者</label>
            <input type="text" id="register_user" name="register_user" class="form-control"
                    value="<?= Util::escape($data["register_user"]); ?>" />
            <span id="register_user_err" class="invalid-feedback"></span>
        </div>
        <div class="col-sm col-lg-6 mb-3">
            <label class="form-label" for="title">登録日</label>
            <input type="date" id="register_date" name="register_date" class="form-control"
                    value="<?= Util::escape($data["register_date"]); ?>" />
            <span id="register_date_err" class="invalid-feedback"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm col-lg-6 mb-3">
            <label class="form-label" for="assignee">担当者</label>
            <input type="text" id="assignee" name="assignee" class="form-control" placeholder="担当者"
                    value="<?= Util::escape($data["assignee"]); ?>" />
            <span id="assignee_err" class="invalid-feedback"></span>
        </div>
        <div class="col-sm col-lg-6 mb-3">
            <label class="form-label" for="target_system">対象システム</label>
            <input type="text" id="target_system" name="target_system" class="form-control" placeholder="対象システム"
                    value="<?= Util::escape($data["target_system"]); ?>" />
            <span id="target_system_err" class="invalid-feedback"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm col-lg-6 mb-3">
            <label class="form-label" for="title">タイトル</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="タイトル"
                    value="<?= Util::escape($data["title"]); ?>" />
            <span id="title_err" class="invalid-feedback"></span>
        </div>
        <div class="col-sm col-lg-6 mb-3">
            <label class="form-label" for="status">ステータス</label>
            <select class="form-select" name="status" id="status">
                    <option value="予定">予定</option>
                    <option value="進行中">進行中</option>
                    <option value="完了">完了</option>
            </select>
            <span id="status_err" class="invalid-feedback"></span>
        </div>
    </div>

    <div class="row">
        <div class="mb-3">
            <label class="form-label" for="content">内容</label>
            <textarea class="form-control" id="content" name="content" placeholder="内容" rows="5"><?= Util::escape($data["content"]); ?></textarea>
            <span id="content_err" class="invalid-feedback"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm col-lg-6 mb-3">
            <label class="form-label" for="plan_start_date">開始予定日</label>
            <input type="date" id="plan_start_date" name="plan_start_date" class="form-control" placeholder="開始予定日"
                    value="<?= Util::escape($data["plan_start_date"]); ?>" />
            <span id="plan_start_date_err" class="invalid-feedback"></span>
        </div>
        <div class="col-sm col-lg-6 mb-3">
            <label class="form-label" for="plan_end_date">終了予定日</label>
            <input type="date" id="plan_end_date" name="plan_end_date" class="form-control" placeholder="終了予定日"
                    value="<?= Util::escape($data["plan_end_date"]); ?>" />
            <span id="plan_end_date_err" class="invalid-feedback"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm col-lg-6 mb-3">
            <label class="form-label" for="actual_start_date">開始日</label>
            <input type="date" id="actual_start_date" name="actual_start_date" class="form-control" placeholder="開始日"
                    value="<?= Util::escape($data["actual_start_date"]); ?>" />
            <span id="actual_start_date_err" class="invalid-feedback"></span>
        </div>
        <div class="col-sm col-lg-6 mb-3">
            <label class="form-label" for="actual_end_date">終了日</label>
            <input type="date" id="actual_end_date" name="actual_end_date" class="form-control" placeholder="終了日"
                    value="<?= Util::escape($data["actual_end_date"]); ?>" />
            <span id="actual_end_date_err" class="invalid-feedback"></span>
        </div>
    </div>

    <div class="row">
        <div class="mb-3">
            <label class="form-label" for="comment">コメント</label>
            <textarea class="form-control" id="comment" name="comment" placeholder="コメント" rows="5"><?= Util::escape($data["comment"]); ?></textarea>
            <span id="comment_err" class="invalid-feedback"></span>
        </div>
    </div>

    <div class="row">
        <div class="mb-2">
            <label class="form-label" for="upload_file">添付ファイル</label>
            <input type="file" multiple id="upload_file" name="upload_file[]" class="form-control" placeholder="添付ファイル" value="" />
        </div>
    </div>

    <?php if ($mode == "edit"): ?>
        <div class="row">
            <div class="mb-3">
                <ul class="list-group">
                    <?php
                        foreach ($data["attaches"] as $attach) {
                            $checked = "";
                            if (isset($deleteAttach) && in_array($attach["attach_id"], $deleteAttach)) {
                                $checked = "checked";
                            }
                    ?>
                        <li class="list-group-item d-flex">
                            <a class="link-dark me-auto" style="text-decoration: none" href="<?= URLROOT ?>/task/download-attach?task_id=<?= $taskId; ?>&attach_id=<?= $attach["attach_id"] ?>">
                                <i class="bi bi-download"></i> <?= $attach["file_name"] ?>
                            </a>
                            <input class="form-check-input" type="checkbox" name="delete_attach_ids[]" value="<?= $attach["attach_id"] ?>" <?= $checked ?>/> 
                            <label class="form-check-label"> 削除 </label>
                        </li>    
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php else: ?>
        <div class="mb-3"></div>
    <?php endif ?>

    <div class="mb-3 d-flex">
        <a class="btn btn-secondary me-2" href="<?= URLROOT ?>/task/home">
            <i class="bi bi-arrow-return-left"></i> キャンセル
        </a>
        <button class="btn btn-primary me-auto" name="save">
            <i class="bi bi-save"></i> 保存
        </button>
        <?php if ($mode == "edit"): ?>
            <input type="hidden" name="task_id" value="<?= $taskId ?>" />
            <button class="btn btn-danger" name="delete"><i class="bi bi-trash"></i> 削除</button>
        <?php endif; ?>
    </div>
</form>