<?php
$ch = curl_init();

$payload = json_encode([
    "userId" => "1",
    "title" => "test",
    "body" => "test"
]);

$options = [
    CURLOPT_URL => "https://jsonplaceholder.typicode.com/posts",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $payload
];

curl_setopt_array($ch, $options);

$res = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo $status. "\n";
echo $res;

curl_close($ch);