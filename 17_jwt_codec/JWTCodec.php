<?php
class JWTCodec {
    public function encode($payload) {
        $header = json_encode([
            "typ" => "JWT",
            "alg" => "HS256"
        ]);
        $header = $this->base64urlEncode($header);

        $payload = json_encode($payload);
        $payload = $this->base64urlEncode($payload);
        
        $signature = hash_hmac("sha256",
                                $header . "." . $payload,
                                "5A7234753778214125442A472D4A614E645267556B58703273357638792F423F",
                                true);
        $signature = $this->base64urlEncode($signature);

        return $header . "." . $payload . "." . $signature;
    }

    private function base64urlEncode($text) {
        return str_replace(
            ["+", "/", "="],
            ["-", "_", ""],
            base64_encode($text)
        );
    }
}