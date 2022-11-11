<?php
require_once "unsplash_key.php";

$ch = curl_init();

$headers = [
    "Authorization: Client-ID $api_key"
];

$options = [
    CURLOPT_URL => "https://api.unsplash.com/photos/random",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $headers,
    // CURLOPT_HEADER => true
];

curl_setopt_array($ch, $options);

$res = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo $status. "\n";
echo $res;

curl_close($ch);