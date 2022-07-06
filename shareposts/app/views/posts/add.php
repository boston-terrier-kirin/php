<?php require APPROOT . "/views/inc/header.php"; ?>

    <a href="<?= URLROOT ?>/posts" class="btn btn-light"><i class="bi bi-arrow-90deg-down"></i> Back</a>
    <div class="card card-body bg-light mt-3">
        <h2>Add Post</h2>
        <p>Create a post with this form</p>
        <form action="<?= URLROOT?>/posts/add" method="post">
            <div class="form-group mb-2">
                <label class="form-label" for="title">Title: <sup>*</sup></label>
                <input class="form-control <?= !empty($data["title_err"]) ? "is-invalid" : "" ?>" type="text" name="title" id="title" value="<?= $data['title'] ?>"/>
                <span class="invalid-feedback"><?= $data["title_err"] ?></span>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="body">Body: <sup>*</sup></label>
                <textarea class="form-control <?= !empty($data["body_err"]) ? "is-invalid" : "" ?>" type="text" name="body" id="body"><?= $data['body'] ?></textarea>
                <span class="invalid-feedback"><?= $data["body_err"] ?></span>
            </div>
            <button name="add" class="btn btn-success">Add Post</button>
        </form>
    </div>

<?php require APPROOT . "/views/inc/footer.php"; ?>