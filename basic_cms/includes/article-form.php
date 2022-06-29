<form method="post">
    <div class="mb-3">
        <label class="form-label" for="title">Title</label>
        <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($title); ?>" />
    </div>
    <div class="mb-3">
        <label class="form-label" for="content">Content</label>
        <textarea class="form-control" id="content" name="content" placeholder="内容" rows="5"><?= htmlspecialchars($content); ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label" for="published_at">Publication date and time</label>
        <input type="datetime-local" id="published_at" name="published_at" class="form-control" placeholder="申請日" value="<?= htmlspecialchars(covertDateTimeToHtmlFormat($publishedAt)); ?>" />
    </div>

    <?php if ($mode == "new"): ?>
        <a class="btn btn-secondary" href="index.php">Back</a>
    <?php endif ?>

    <?php if ($mode == "edit"): ?>
        <a class="btn btn-secondary" href="article.php?id=<?= $id ?>">Back</a>
    <?php endif ?>

    <button class="btn btn-primary" name="save">Save</button>
</form>