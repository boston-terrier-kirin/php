<?php
require __DIR__ . "/vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$database = new Database($_ENV["DB_HOST"], $_ENV["DB_NAME"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);
$refreshTokenGateway = new RefreshTokenGateway($database, $_ENV["SECRET_KEY"]);

$refreshTokenGateway->deleteExpired();


/**
 * expireしたリフレッシュトークンが残り続けるので、なにがしかの方法で削除する必要が発生してしまう。
 */