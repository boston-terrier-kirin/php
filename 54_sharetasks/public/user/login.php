<?php
require_once("../bootstrap.php");

$errors = [];
$data = [];
foreach(UserService::$loginColumnDef as $key => $def) {
    $data[$key] = $def["initValue"];
}

if (isset($_POST["login"])) {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    foreach($data as $key => $value) {
        $data[$key] = $_POST[$key];
    }

    $userService = new UserService();
    $errors = $userService->validate($data);

    if (empty($errors)) {
        if ($userService->authenticate($data)) {
            session_regenerate_id(true);
            $_SESSION["is_logged_in"] = true;
            $_SESSION["username"] = $data["username"];

            Util::registerMessage("Welcome back, " . $data['username']);
            Util::redirect("/task/home");
        } else {
            $errors["username"] = "Invalid Credentials.";
            $errors["password"] = "Invalid Credentials."; 
        }
    }
}
?>

<?php require_once APPROOT . "/includes/shared/header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <?php require_once APPROOT . "/includes/shared/message.php"; ?>
            <div class="card bg-light">
                <div class="card-body">
                    <h2>Login</h2>
                    <p>Please fill in your credentials to log in</p>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label" for="username">Username: <sup>*</sup></label>
                            <input type="text" id="username" name="username" class="form-control" value="<?= Util::escape($data["username"]); ?>" />
                            <span id="username_err" class="invalid-feedback"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password: <sup>*</sup></label>
                            <input type="password" id="password" name="password" class="form-control"
                                    value="<?= Util::escape($data["password"]); ?>" />
                            <span id="password_err" class="invalid-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="d-grid col-6 mx-auto">
                                <button name="login" class="btn btn-success">Login</button>
                            </div>
                            <div class="d-grid col-6 mx-auto">
                                <a href="<?= URLROOT ?>/user/register" name="register" id="register" class="btn btn-secondary">No account? Register</a>
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