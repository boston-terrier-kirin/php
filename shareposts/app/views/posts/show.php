<?php require APPROOT . "/views/inc/header.php"; ?>

    <a href="<?= URLROOT ?>/posts" class="btn btn-light d-inline-block mb-3"><i class="bi bi-arrow-90deg-down"></i> Back</a>
    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title"><?= $data["post"]->title ?></h4>
            <div class="bg-light rounded p-2 mb-3">
                Written by <?= $data["post"]->name ?> on <?= $data["post"]->created_at ?>
            </div>
            <p class="card-text"><?= $data["post"]->body ?></p>
            <?php if($data["post"]->user_id == $_SESSION["user_id"]): ?>
                <a href="<?= URLROOT ?>/posts/edit/<?= $data["post"]->postId ?>" class="btn btn-success">Edit</a>
                <form class="d-inline" action="<?= URLROOT ?>/posts/delete/<?= $data["post"]->postId ?>" method="post">
                    <button name="delete" class="btn btn-danger">Delete</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

<?php require APPROOT . "/views/inc/footer.php"; ?>