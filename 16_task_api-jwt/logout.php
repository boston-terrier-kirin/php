<?php
require __DIR__ . "/bootstrap.php";

$method = $_SERVER["REQUEST_METHOD"];

if ($method != "POST") {
    http_response_code(405);
    header("Allow: POST");
    exit;
}

$data = (array) json_decode(file_get_contents("php://input"), true);

if (!array_key_exists("token", $data)) {
    http_response_code(400);
    echo json_encode([
        "message" => "Missing token"
    ]);
    exit;
}

$codec = new JWTCodec($_ENV["SECRET_KEY"]);

try {
    $payload = $codec->decode($data["token"]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["message" => $e->getMessage()]);
    exit;
}

$database = new Database($_ENV["DB_HOST"], $_ENV["DB_NAME"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);
$refreshTokenGateway = new RefreshTokenGateway($database, $_ENV["SECRET_KEY"]);
$refreshTokenGateway->delete($data["token"]);
