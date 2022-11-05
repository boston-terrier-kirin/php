<?php
function getConnection() {
    $db_host = "localhost";
    $db_name = "php_cms";
    $db_user = "php_cms";
    $db_pass = "php_cms";

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }

    return $conn;
}
?>