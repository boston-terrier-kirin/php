<?php
class Auth {
    private $userGateway;
    private $userId;

    public function __construct($userGateway) {
        $this->userGateway = $userGateway;
    }

    public function authenticateAccessToken() {

        $authorization = $_SERVER["HTTP_AUTHORIZATION"];
        if (!$authorization) {
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid authorization header -1"
            ]);
            return false;
        }

        $token = explode(" ", $authorization)[1];
        $plain = base64_decode($token, true);

        if (!$plain) {
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid authorization header -2"
            ]);
            return false;
        }

        $data = json_decode($plain, true);
        if (!$data) {
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid authorization header -3"
            ]);
            return false;
        }

        $this->userId = $data["id"];

        return true;
    }

    public function getUserId() {
        return $this->userId;
    }
}