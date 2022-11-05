<?php
require "classes/Database.php";
require "classes/User.php";

$db = new Database();
$conn = $db->getConnection();

$users = User::getAll($conn);
?>

<?= json_encode($users); ?>