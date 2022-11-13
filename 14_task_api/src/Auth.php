<?php
class Auth {
    private $userGateway;
    private $usreId;

    public function __construct($userGateway) {
        $this->userGateway = $userGateway;
    }

    public function authenticateApiKey() {
        // headerにx-api-keyをつけると、これでGETできる。
        if (empty($_SERVER["HTTP_X_API_KEY"])) {
            http_response_code(400);
            echo json_encode([
                "message" => "Missing api key"
            ]);
            return false;
        }

        $apiKey = $_SERVER["HTTP_X_API_KEY"];
        $user = $this->userGateway->getByApiKey($apiKey);

        if (!$user) {
            http_response_code(401);
            echo json_encode([
                "message" => "Invalid api key"
            ]);
            return false;
        }

        $this->usreId = $user["id"];

        return true;
    }

    public function getUserId() {
        return $this->usreId;
    }
}