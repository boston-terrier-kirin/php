<?php
require "JWTCodec.php";

$payload = ["id" => 123];
$codec = new JWTCodec("5A7234753778214125442A472D4A614E645267556B58703273357638792F423F");

$token = $codec->encode($payload);

$decoded_payload = $codec->decode($token);

echo $token;
echo "<br />-----<br />";
print_r($decoded_payload);
