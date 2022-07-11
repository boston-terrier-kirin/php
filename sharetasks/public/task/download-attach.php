<?php
require_once("../bootstrap.php");

Auth::requireLogin();

$taskId = $_GET["task_id"];
$attachId = $_GET["attach_id"];

$attachService = new AttachService();
$attach = $attachService->getByAttachId($attachId);
$fileName = $attach["file_name"];

$filePath = UPLOAD_FOLDER . "/$taskId/$fileName";

// TODO: PHP5.4 ではfinfoを動かすのに設定が必要になりそう。
// $media_type = (new finfo())->file($filePath, FILEINFO_MIME_TYPE) ?? 'application/octet-stream';
$media_type = 'application/octet-stream';

header('Content-Type: ' . $media_type);
header('X-Content-Type-Options: nosniff');
header('Content-Length: ' . filesize($filePath));
header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');

while (ob_get_level()) ob_end_clean();
readfile($filePath);

exit;
?>