<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?= URLROOT ?>"><?= SITENAME ?></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= URLROOT ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT ?>/pages/about">About</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <?php if (isset($_SESSION["user_id"])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URLROOT ?>/users/logout">Logout</a>
                    </li>                
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= URLROOT ?>/users/register">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URLROOT ?>/users/login">Login</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>