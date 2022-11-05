<?php

// foreach
$users = [
    "id1" => "john",
    "id2" => "jane",
    "id3" => "stephen"
];

// keyが不要な場合
foreach($users as $user) {
    var_dump($user);
    echo "<br />";
}
echo "<br />-----<br />";

// keyが必要な場合
foreach($users as $key => $user) {
    echo $key . ": " . $user;
    echo "<br />";
}
echo "<br />-----<br />";

// for
$items = ["Apple", "Orange", "Mango"];
for ($i = 0; $i < count($items); $i ++) {
    print $items[$i] . "<br />";
}
echo "<br />-----<br />";

// while
$i = 0;
while ($i < count($items)) {
    print $items[$i] . "<br />";
    $i ++;
}
