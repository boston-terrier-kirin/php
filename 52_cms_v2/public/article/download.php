<?php
require_once("../bootstrap.php");

Auth::requireLogin();

$articleId = $_GET["article_id"];
$imageId = $_GET["image_id"];

$articleImage = new ArticleImage();
$image = $articleImage->getImageById($imageId);
$fileName = $image["file_name"];

$file_path = UPLOAD_FOLDER . "/$articleId/$fileName";
$media_type = (new finfo())->file($file_path, FILEINFO_MIME_TYPE) ?? 'application/octet-stream';

header('Content-Type: ' . $media_type);
header('X-Content-Type-Options: nosniff');
header('Content-Length: ' . filesize($file_path));
header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');

while (ob_get_level()) ob_end_clean();
readfile($file_path);

exit;
?>