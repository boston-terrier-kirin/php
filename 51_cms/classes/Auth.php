<?php
class Auth {
    public static function isLoggedIn() {
        return isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"];
    }

    public static function requireLogin() {
        if (!Auth::isLoggedIn()) {
            Util::redirect("/login.php");
        }
    }
}
?>