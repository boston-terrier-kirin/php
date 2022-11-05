<form method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label" for="title">Title</label>
        <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($title); ?>" />
        <span id="title_err" class="invalid-feedback"></span>
    </div>
    <div class="mb-3">
        <label class="form-label" for="content">Content</label>
        <textarea class="form-control" id="content" name="content" placeholder="内容" rows="5"><?= htmlspecialchars($content); ?></textarea>
        <span id="content_err" class="invalid-feedback"></span>
    </div>
    <div class="mb-3">
        <label class="form-label" for="published_at">Publication date and time</label>
        <input type="datetime-local" id="published_at" name="published_at" class="form-control" placeholder="申請日"
                value="<?= htmlspecialchars(Util::covertDateTimeToHtmlFormat($publishedAt)); ?>" />
    </div>
    <div class="mb-2">
        <label class="form-label" for="upload_file">Image</label>
        <input type="file" multiple id="upload_file" name="upload_file[]" class="form-control" placeholder="Upload File" value="" />
    </div>
    <?php if ($mode == "edit"): ?>
        <div class="mb-4">
            <ul class="list-group">
                <?php
                    foreach ($images as $image) {
                        $checked = "";
                        if (isset($deleteImage) && in_array($image["id"], $deleteImage)) {
                            $checked = "checked";
                        }
                ?>
                    <li class="list-group-item d-flex">
                        <a class="link-dark me-auto" style="text-decoration: none" href="<?= URLROOT ?>/article/download?article_id=<?= $id; ?>&image_id=<?= $image["id"] ?>">
                            <i class="bi bi-download"></i> <?= $image["file_name"] ?>
                        </a>
                        <input class="form-check-input" type="checkbox" name="deleteImage[]" value="<?= $image["id"] ?>" <?= $checked ?>/> 
                        <label class="form-check-label"> Delete </label>
                    </li>    
                <?php } ?>
            </ul>
        </div>
    <?php else: ?>
        <div class="mb-4"></div>
    <?php endif ?>

    <?php if ($mode == "new"): ?>
        <a class="btn btn-secondary" href="<?= URLROOT ?>/article/home">
            <i class="bi bi-arrow-return-left"></i> Back
        </a>
    <?php endif ?>

    <?php if ($mode == "edit"): ?>
        <a class="btn btn-secondary" href="<?= URLROOT ?>/article/article?id=<?= $id ?>">
            <i class="bi bi-arrow-return-left"></i> Back
        </a>
    <?php endif ?>

    <button class="btn btn-primary" name="save">
        <i class="bi bi-save"></i> Save
    </button>
</form>