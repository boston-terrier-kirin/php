<?php
$output = substr("Hello", 1);
echo $output;
echo "<br />-----<br />";

$output = substr("KSB123456789", 3);
echo $output;
echo "<br />-----<br />";

//                01234
$output = substr("Hello", 1, 3);
echo $output;
echo "<br />-----<br />";

$output = substr("KSB123456789", -3);
echo $output;
echo "<br />-----<br />";

$output = strlen("john");
echo $output;
echo "<br />-----<br />";

// utf-8のバイト数
$output = strlen("山田太郎");
echo $output;
echo "<br />-----<br />";

// 最初の o の位置
$output = strpos("Hello World", "o");
echo $output;
echo "<br />-----<br />";

// 最後の o の位置
$output = strrpos("Hello World", "o");
echo $output;
echo "<br />-----<br />";

$text = trim("Hello World   ");
var_dump($text);
echo "<br />-----<br />";

$text = str_replace("World", "Everyone", "Hello World");
var_dump($text);
echo "<br />-----<br />";

$output = is_string('Hello');
echo $output;
echo "<br />";
echo true; // trueは1で表示される。
echo "<br />-----<br />";

// phpではiterableではない
// $output = "123456789";
// foreach ($output as $t) {
//     echo $t;
// } 
