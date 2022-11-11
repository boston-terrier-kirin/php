<?php
require_once "github_key.php";

$ch = curl_init();

$headers = [
    "Authorization:token $api_key",
    "User-Agent: kirin-boston-terrior"
];

$options = [
    CURLOPT_URL => "https://api.github.com/search/users?q=boston-terrier-kirin",
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