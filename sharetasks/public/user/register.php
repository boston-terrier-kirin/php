<?php
require_once("../bootstrap.php");

$errors = [];
$username = "";
$email = "";
$password = "";
$confirmPassword = "";

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    $errors = UserService::validateRegister($username, $email, $password, $confirmPassword);

    if (empty($errors)) {
        $userService = new UserService();
        $userService->register($username, $email, $password);

        Util::registerMessage("register_success", "You are registered and can log in");
        Util::redirect("/user/login");
    }
}
?>

<?php require_once APPROOT . "/includes/shared/header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <?php require_once APPROOT . "/includes/shared/global-error.php"; ?>
            <div class="card bg-light">
                <div class="card-body">
                    <h2>Create An Account</h2>
                    <p>Please fill out this form to register with us</p>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label" for="username">Username: <sup>*</sup></label>
                            <input type="text" id="username" name="username" class="form-control" value="<?= htmlspecialchars($username); ?>" />
                            <span id="username_err" class="invalid-feedback"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email: <sup>*</sup></label>
                            <input type="text" id="email" name="email" class="form-control" value="<?= htmlspecialchars($email); ?>" />
                            <span id="email_err" class="invalid-feedback"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password: <sup>*</sup></label>
                            <input type="password" id="password" name="password" class="form-control"
                                    value="<?= htmlspecialchars($password); ?>" />
                            <span id="password_err" class="invalid-feedback"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="confirm_password">Confirm Password: <sup>*</sup></label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control"
                                    value="<?= htmlspecialchars($confirmPassword); ?>" />
                            <span id="confirm_password_err" class="invalid-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="d-grid col-6 mx-auto">
                                <button name="register" class="btn btn-success">Register</button>
                            </div>
                            <div class="d-grid col-6 mx-auto">
                                <a href="<?= URLROOT ?>/user/login" name="register" class="btn btn-secondary">Have an account? Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once APPROOT . "/includes/shared/script.php"; ?>
<?php require_once APPROOT . "/includes/shared/footer.php"; ?>