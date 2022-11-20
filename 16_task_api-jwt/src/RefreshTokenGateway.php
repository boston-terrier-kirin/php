<?php
class RefreshTokenGateway {
    private $conn;
    private $key;

    public function __construct($database, $key) {
        $this->conn = $database->getConnection();
        $this->key = $key;
    }

    public function create($token, $expiry) {
        $hash = hash_hmac("sha256", $token, $this->key);
        
        $sql = "insert into refresh_token(token_hash, expires_at)
                values(:token_hash, :expires_at)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue("token_hash", $hash, PDO::PARAM_STR);
        $stmt->bindValue("expires_at", $expiry, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete($token) {
        $hash = hash_hmac("sha256", $token, $this->key);

        $sql = "delete from refresh_token where token_hash = :token_hash";

        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue("token_hash", $hash, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function getByToken($token) {
        $hash = hash_hmac("sha256", $token, $this->key);

        $sql = "select * from refresh_token where token_hash = :token_hash";

        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue("token_hash", $hash, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteExpired() {
        $sql = "delete from refresh_token where expires_at < unix_timestamp()";
        $stmt = $this->conn->query($sql);
        return $stmt->rowCount();
    }
}