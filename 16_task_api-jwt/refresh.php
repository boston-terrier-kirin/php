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

$user_id = $payload["sub"];

$database = new Database($_ENV["DB_HOST"], $_ENV["DB_NAME"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);
$userGateway = new UserGateway($database);
$refreshTokenGateway = new RefreshTokenGateway($database, $_ENV["SECRET_KEY"]);

if (!$refreshTokenGateway->getByToken($data["token"])) {
    http_response_code(401);
    echo json_encode(["message" => "Invalid token (not on whitelist)"]);
    exit;
}

$user = $userGateway->getById($user_id);
if (!$user) {
    http_response_code(401);
    echo json_encode(["message" => "Invalid authentication"]);
    exit;
}

$payload = [
    "sub" => $user["id"],
    "name" => $user["name"],
    "exp" => time() + 600
];

$accessToken = $codec->encode($payload);

$expiry = time() + 432000;
$refreshToken = $codec->encode([
    "sub" => $user["id"],
    "exp" => $expiry
]);

echo json_encode([
    "access_token" => $accessToken,
    "refresh_token" => $refreshToken
]);

$refreshTokenGateway->delete($data["token"]);
$refreshTokenGateway->create($refreshToken, $expiry);