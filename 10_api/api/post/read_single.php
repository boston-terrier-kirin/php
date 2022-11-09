<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

$db = new Database();
$conn = $db->connect();

$post = new Post($conn);

$post->id = isset($_GET["id"]) ? $_GET["id"] : die();

$post->read_single();

$post_arr = [
    "id" => $post->id,
    "title" => $post->title,
    "body" => $post->body,
    "author" => $post->author,
    "category_id" => $post->category_id,
    "category_name" => $post->category_name,
];

echo json_encode($post_arr);