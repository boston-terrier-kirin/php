<?php
require __DIR__ . "/vendor/autoload.php";

$client = new GuzzleHttp\Client;

$res = $client->request("GET", "https://jsonplaceholder.typicode.com/posts/1");

echo $res->getStatusCode(), "\n";
echo $res->getBody();
