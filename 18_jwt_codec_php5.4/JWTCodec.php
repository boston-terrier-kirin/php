<?php
class JWTCodec {

    private $key;

    public function __construct($key) {
        $this->key = $key;
    }

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
                                $this->key,
                                true);
        $signature = $this->base64urlEncode($signature);

        return $header . "." . $payload . "." . $signature;
    }

    public function decode($token) {
        $parts = explode(".", $token);
        $header = $parts[0];
        $payload = $parts[1];
        $signature_from_token = $parts[2];

        $signature = hash_hmac("sha256",
                                $header . "." . $payload,
                                $this->key,
                                true);
        $signature_from_token = $this->base64urlDecode($signature_from_token);

        if (!$this->hash_equals($signature, $signature_from_token)) {
            throw new Exception("Invalid token");
        }

        return json_decode($this->base64urlDecode($payload), true);
    }

    private function base64urlEncode($text) {
        return str_replace(
            ["+", "/", "="],
            ["-", "_", ""],
            base64_encode($text)
        );
    }

    private function base64urlDecode($text) {
        return base64_decode(str_replace(
            ["-", "_"],
            ["+", "/"],
            $text)
        );
    }

    // php5.4にはhash_equalsがないので自作
    // https://stackoverflow.com/questions/32671908/hash-equals-alternative-for-php-5-5-9
    private function hash_equals($str1, $str2) {
        if(strlen($str1) != strlen($str2)) {
          return false;
        } else {
          $res = $str1 ^ $str2;
          $ret = 0;
          for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
          return !$ret;
        }
    }
}