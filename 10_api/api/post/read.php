<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

$db = new Database();
$conn = $db->connect();

$post = new Post($conn);
$result = $post->read();
$num = $result->rowCount();

if ($num > 0) {
    $res = [];
    $res["data"] = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = [
            "id" => $id,
            "title" => $title,
            "body" => html_entity_decode($body),
            "author" => $author,
            "category_id" => $category_id,
            "category_name" => $category_name
        ];

        array_push($res["data"], $post_item);
    }

    echo json_encode($res);
} else {
    echo json_encode([
        "message" => "No posts found"
    ]);
}