<?php
require "classes/Database.php";
require "classes/Auth.php";
require "classes/Util.php";
require "classes/Article.php";
require "classes/ArticleImage.php";

session_start();
Auth::requireLogin();

$articleId = $_GET["article_id"];
$imageId = $_GET["image_id"];

$db = new Database();
$conn = $db->getConnection();
$image = ArticleImage::getImageById($conn, $imageId);
$fileName = $image["file_name"];

$file_path = __dir__ . "/uploads/$articleId/$fileName";
$media_type = (new finfo())->file($file_path, FILEINFO_MIME_TYPE) ?? 'application/octet-stream';

header('Content-Type: ' . $media_type);
header('X-Content-Type-Options: nosniff');
header('Content-Length: ' . filesize($file_path));
header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');

while (ob_get_level()) ob_end_clean();
readfile($file_path);

exit;
?>