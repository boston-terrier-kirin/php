<?php
require_once("../bootstrap.php");

Auth::requireLogin();

$data = [
    "id" => 123,
    "name" => "Dave",
    "email" => "dave@test.com",
    "dob" => "1985-05-15"
];
?>

<?= json_encode($data); ?>