<?php
require "includes/util.php";

session_start();

$username = "";
$password = "";

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    session_regenerate_id(true);
    $_SESSION["is_logged_in"] = true;
    redirect("/index.php");
}
?>

<?php require("includes/header.php"); ?>

<div class="container">
    <form method="post">
        <div class="mb-3">
            <label class="form-label" for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" value="<?= htmlspecialchars($username); ?>" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" value="<?= htmlspecialchars($password); ?>" />
        </div>
        <button class="btn btn-primary" name="login">Log in</button>
    </form>
</div>

<?php require("includes/header.php"); ?>