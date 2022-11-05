<?php

// Indexed
$articles = ["post#1", "post#2", "post#3"];
$articles[] = "post#4";

print $articles[0];
echo "<br />-----<br />";

var_dump($articles);
echo "<br />-----<br />";

// Assoc
$users = [
    "id1" => "john",
    "id2" => "jane"
];
var_dump($users);
echo "<br />-----<br />";

print $users["id1"] . "/" . $users["id2"];
echo "<br />-----<br />";

// Warning: Undefined array key "idx" 
print $users["idx"];
echo "<br />-----<br />";

// assocの上書き
$users["id1"] = "John Doe";
$users["id2"] = "Jane Doe";
print $users["id1"] . "/" . $users["id2"];
echo "<br />-----<br />";

// assocに追加
$users["id3"] = "Stephen Curry";
var_dump($users);
echo "<br />-----<br />";

// count
echo count($users);
echo "<br />-----<br />";

// print_r, var_dumpより情報少なめのすっきり感あり
print_r($users);
echo "<br />-----<br />";

$user_items = [
    "user1" => [1, 2, 3],
    "user2" => ["Apple", "Orange", "Mango"]
];

print_r($user_items);