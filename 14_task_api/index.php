<?php
require __DIR__ . "/vendor/autoload.php";

set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleException");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$path = parse_url($_SERVER["REQUEST_URI"]);
$parts = explode("/", $path["path"]);
$resource = $parts[2];
$id = $parts[3] ?? null;

$method = $_SERVER["REQUEST_METHOD"];

if ($resource != "tasks") {
    http_response_code(404);
    exit;
}

header("Content-Type: application/json; chaset=UTF-8");

$database = new Database($_ENV["DB_HOST"], $_ENV["DB_NAME"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);
$taskGateway = new TaskGateway($database);
$taskController = new TaskController($taskGateway);
$taskController->processRequest($method, $id);