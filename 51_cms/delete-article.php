<?php
require "classes/Database.php";
require "classes/Auth.php";
require "classes/Article.php";
require "classes/Util.php";

session_start();
Auth::requireLogin();

$id = null;

if (isset($_POST["delete"])) {
    $id = $_POST["id"];

    $db = new Database();
    $conn = $db->getConnection();
    Article::delete($conn, $id);
    Util::redirect("/index.php");
}
?>