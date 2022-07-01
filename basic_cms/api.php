<?php

require "classes/Database.php";
require "classes/Auth.php";
require "classes/Util.php";

session_start();
Auth::requireLogin();

$data = [
    "id" => 123,
    "name" => "Dave",
    "email" => "dave@test.com",
    "dob" => "1985-05-15"
];
?>

<?= json_encode($data); ?>