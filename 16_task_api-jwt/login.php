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

if (!password_verify($data["password"], $user["password"])) {
    http_response_code(401);
    echo json_encode([
        "message" => "Invalid credentials -2"
    ]);
    exit;
}

// time()は秒単位なので、同じユーザIDで1秒以内にtokenを作ると、同じaccessTokenになる。
$accessTokenExp = time() + 600; 
$payload = [
    "sub" => $user["id"],
    "name" => $user["name"],
    "exp" => $accessTokenExp
];

$codec = new JWTCodec($_ENV["SECRET_KEY"]);
$accessToken = $codec->encode($payload);

// time()は秒単位なので、同じユーザIDで1秒以内にtokenを作ると、同じrefreshTokenになる。
// refreshTokenが重複するとDBでキー重複になるので、rand(-600, 600)で幅を持たせる。
$refreshTokenExp = time() + 432000 + rand(-600, 600);
$refreshToken = $codec->encode([
    "sub" => $user["id"],
    "exp" => $refreshTokenExp
]);

echo json_encode([
    "access_token" => $accessToken,
    "refresh_token" => $refreshToken,
]);

/**
 * payloadに入っているユーザ情報の変更が反映されないので、本物トークンは有効期限を短くする。
 * 代わりにリフレッシュトークンの有効期限は長くする。
 * 
 * 定期的にリフレッシュさせるのが目的らしい。
 */
$refreshTokenGateway = new RefreshTokenGateway($database, $_ENV["SECRET_KEY"]);
$refreshTokenGateway->create($refreshToken, $refreshTokenExp);