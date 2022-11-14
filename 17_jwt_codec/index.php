<?php
require "JWTCodec.php";

$payload = ["id" => 123];
$codec = new JWTCodec();
echo $codec->encode($payload);