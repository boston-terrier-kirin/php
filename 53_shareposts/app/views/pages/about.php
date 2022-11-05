<?php require APPROOT . "/views/inc/header.php"; ?>
    <div class="bg-light p-2 rounded">
        <div class="container">
            <h1 class="display-4"><?= $data["title"] ?></h1>
            <p class="lead"><?= $data["description"] ?></p>
            <p class="lead">Version: <?= APPVERSION ?></p>
        </div>
    </div>
<?php require APPROOT . "/views/inc/footer.php"; ?>
