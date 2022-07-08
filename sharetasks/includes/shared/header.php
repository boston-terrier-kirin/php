<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= URLROOT ?>/css/style.css">
    <title><?= SITENAME ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <div class="container d-flex">
            <a class="navbar-brand mb-0 h1 me-auto" href="<?= URLROOT ?>/task/home"><i class="bi bi-list-task"></i> <?= SITENAME ?></a>
            <ul class="navbar-nav align-items-center">
                <?php if (Auth::isLoggedIn()): ?>
                    <li class="nav-item text-light me-3">
                        <i class="bi bi-person-fill"></i> <?= Auth::getUser() ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= URLROOT ?>/user/logout"><i class="bi bi-box-arrow-right"></i> Log out</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
