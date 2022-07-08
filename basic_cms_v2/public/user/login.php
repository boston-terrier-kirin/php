<?php
require_once("../bootstrap.php");

$errors = [];
$username = "";
$password = "";

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = new User();

    if ($user->authenticate($username, $password)) {
        session_regenerate_id(true);
        $_SESSION["is_logged_in"] = true;
        Util::redirect("/article/home");
    } else {
        $errors["username"] = "Invalid Credentials.";
        $errors["password"] = "Invalid Credentials."; 
    }
}
?>

<?php require_once APPROOT . "/includes/shared/header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <?php require_once APPROOT . "/includes/shared/global-error.php"; ?>
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="<?= htmlspecialchars($username); ?>" />
                            <span id="username_err" class="invalid-feedback"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                    value="<?= htmlspecialchars($password); ?>" />
                            <span id="password_err" class="invalid-feedback"></span>
                        </div>
                        <button class="btn btn-primary" name="login">
                            <i class="bi bi-box-arrow-in-right"></i> Log in
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once APPROOT . "/includes/shared/script.php"; ?>
<?php require_once APPROOT . "/includes/shared/footer.php"; ?>