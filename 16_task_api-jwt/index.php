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
$userGateway = new UserGateway($database);
$jwtCodec = new JWTCodec($_ENV["SECRET_KEY"]);
$auth = new Auth($userGateway, $jwtCodec);

if (!$auth->authenticateAccessToken()) {
    exit;
}

$userId = $auth->getUserId();

$taskGateway = new TaskGateway($database);
$taskController = new TaskController($userId, $taskGateway);
$taskController->processRequest($method, $id);