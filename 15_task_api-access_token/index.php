<?php
require __DIR__ . "/bootstrap.php";

$path = parse_url($_SERVER["REQUEST_URI"]);
$parts = explode("/", $path["path"]);
$resource = $parts[2];
$id = $parts[3] ?? null;

$method = $_SERVER["REQUEST_METHOD"];

if ($resource != "tasks") {
    http_response_code(404);
    exit;
}

$database = new Database($_ENV["DB_HOST"], $_ENV["DB_NAME"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);

/**
 * access_token
 * 最初にログインさせて、base64したtokenをGETする。
 * 後は、Authorization: Bearer eyJpZCI6NSwibmFtZSI6ImtvaGVpIn0= すればOKなので、毎回DBを見に行かなくてもOKになる。
 */

// Authorizationの取り方
// (1) apacheがHTTP_AUTHORIZATIONを消してしまうので、.htaccessを変える
// var_dump($_SERVER["HTTP_AUTHORIZATION"]);
// (2) apache_request_headersからGETする
// $headers = apache_request_headers();
// echo $headers["Authorization"];

$userGateway = new UserGateway($database);
$auth = new Auth($userGateway);

if (!$auth->authenticateAccessToken()) {
    exit;
}

$userId = $auth->getUserId();

$taskGateway = new TaskGateway($database);
$taskController = new TaskController($userId, $taskGateway);
$taskController->processRequest($method, $id);