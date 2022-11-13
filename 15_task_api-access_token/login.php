<?php
require __DIR__ . "/bootstrap.php";

$method = $_SERVER["REQUEST_METHOD"];

if ($method != "POST") {
    http_response_code(405);
    header("Allow: POST");
    exit;
}

$data = (array) json_decode(file_get_contents("php://input"), true);

if (!array_key_exists("username", $data) ||
    !array_key_exists("password", $data)) {
    http_response_code(400);
    echo json_encode([
        "message" => "Missing login credentials"
    ]);
    exit;
}

$database = new Database($_ENV["DB_HOST"], $_ENV["DB_NAME"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);
$userGateway = new UserGateway($database);
$user = $userGateway->getByUsername($data["username"]);

if (!$user) {
    http_response_code(401);
    echo json_encode([
        "message" => "Invalid credentials -1"
    ]);
    exit;
}

if (password_verify($data["password"], $user["password"])) {
    http_response_code(401);
    echo json_encode([
        "message" => "Invalid credentials -2"
    ]);
    exit;
}

$payload = [
    "id" => $user["id"],
    "name" => $user["name"]
];

$accessToken = base64_encode(json_encode($payload));

echo json_encode([
    "access_token" => $accessToken
]);