<?php
require "classes/Database.php";
require "classes/Auth.php";
require "classes/User.php";
require "classes/Util.php";

session_start();

// TODO: ログインしないで直接案件を指定してアクセスした場合
// リダイレクトされてくるので、URLパラメータからidを取得する。
// var_dump($_GET);

$errors = [];
$username = "";
$password = "";

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $db = new Database();
    $conn = $db->getConnection();

    if (User::authenticate($conn, $username, $password)) {
        session_regenerate_id(true);
        $_SESSION["is_logged_in"] = true;
        Util::redirect("/index.php");
    } else {
        $errors[] = "Invalid Credentials.";
    }
}
?>

<?php require("includes/header.php"); ?>

<div class="container">
    <?php require("includes/error.php"); ?>
    <div class="card">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?= htmlspecialchars($username); ?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" value="<?= htmlspecialchars($password); ?>" />
                </div>
                <button class="btn btn-primary" name="login">
                    <i class="bi bi-box-arrow-in-right"></i> Log in
                </button>
            </form>
        </div>
    </div>
</div>

<?php require("includes/footer.php"); ?>