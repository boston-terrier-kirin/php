<?php
session_start();

// registerMessageとshowMessageの2つに分ける
// function flashMessage($name = "", $message = "", $className = "alert alert-success") {
//     if (!empty($name)) {
//         if (!empty($message) && empty($_SESSION[$name])) {
//             if (!empty($_SESSION[$name])) {
//                 unset($_SESSION[$name]);
//             }
//             if (!empty($_SESSION[$name . "_class"])) {
//                 unset($_SESSION[$name . "_class"]);
//             }

//             $_SESSION[$name] = $message;
//             $_SESSION[$name . "_class"] = $className;
//         } elseif (empty($message) && !empty($_SESSION[$name])) {
//             $className = !empty($_SESSION[$name . "_class"]) ? $_SESSION[$name . "_class"] : "";
//             echo "<div class='" . $className . "' id='msg-flash'>" . $_SESSION[$name] . "</div>";

//             unset($_SESSION[$name]);
//             unset($_SESSION[$name . "_class"]);
//         }
//     }
// }

function registerMessage($name, $message, $className = "alert alert-success") {
    $_SESSION[$name] = $message;
    $_SESSION[$name . "_class"] = $className;
}

function showMessage($name) {
    if (!empty($_SESSION[$name])) {
        $className = !empty($_SESSION[$name . "_class"]) ? $_SESSION[$name . "_class"] : "";
        echo "<div class='" . $className . "' id='msg-flash'>" . $_SESSION[$name] . "</div>";

        unset($_SESSION[$name]);
        unset($_SESSION[$name . "_class"]);
    }
}

function isLoggedIn() {
    if (isset($_SESSION["user_id"])) {
        return true;
    }
    return false;
}