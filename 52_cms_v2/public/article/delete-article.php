<?php
require_once("../bootstrap.php");

Auth::requireLogin();

$id = null;

if (isset($_POST["delete"])) {
    $id = $_POST["id"];

    $article = new Article();
    $article->delete($id);

    Util::redirect("/article/home");
}
?>