<?php
class Auth {
    private $userGateway;
    private $jwtCodec;
    private $userId;

    public function __construct($userGateway, $jwtCodec) {
        $this->userGateway = $userGateway;
        $this->jwtCodec = $jwtCodec;
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

        try {
            $data = $this->jwtCodec->decode($token);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
            return false;
        }

        $this->userId = $data["sub"];

        return true;
    }

    public function getUserId() {
        return $this->userId;
    }
}