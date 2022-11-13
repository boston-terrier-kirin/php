<?php

$data = [
    "name" => "test#1",
    "title" => "title#1"
];

// キーだけを取得する
var_dump(array_keys($data));
echo "<br />-----<br />";

// mapが使える
$sets = array_map(function($value) {
    return "$value = :$value";
}, array_keys($data));

var_dump($sets);
echo "<br />-----<br />";

// implodeはjoinと同じ
echo implode(", ", $sets);