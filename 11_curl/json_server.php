<?php
// POST
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
echo "-----\n";

// GET
$ch = curl_init();
$options = [
    CURLOPT_URL => "https://jsonplaceholder.typicode.com/posts/1",
    CURLOPT_RETURNTRANSFER => true,
];

curl_setopt_array($ch, $options);

$res = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Warning: Array to string conversion になるから変な値が返ってきているのかと思いきや、単純に配列をechoできないだけだった。
// echo json_decode($res, true);

$data = json_decode($res, true);
print_r($data);
print_r($data["title"]);