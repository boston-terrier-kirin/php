<?php require APPROOT . "/views/inc/header.php"; ?>

    <div class="row">
        <div class="col px-0">
            <?php showMessage("post_added") ?>
            <?php showMessage("post_edited") ?>
        </div>
    </div>

    <div class="row align-items-center mb-3">
        <div class="col-md-6 px-0">
            <h1>Posts</h1>
        </div>
        <div class="col-md-6 px-0 d-flex">
            <a href="<?= URLROOT ?>/posts/add" class="btn btn-primary ms-auto">
                <i class="bi bi-pencil"></i> Add Post
            </a>
        </div>
    </div>

    <div class="row">
        <?php foreach($data["posts"] as $post): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title"><?= $post->title ?></h4>
                    <div class="bg-light rounded p-2 mb-3">
                        Written by <?= $post->name ?> on <?= $post->created_at ?>
                    </div>
                    <p class="card-text"><?= $post->body ?></p>
                    <a href="<?= URLROOT ?>/posts/show/<?= $post->postId ?>" class="btn btn-dark d-inline">More</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php require APPROOT . "/views/inc/footer.php"; ?>