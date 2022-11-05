<?php

$message = "Hello again!";

// 文字列の結合は、. でやる。
echo $message . "!";
echo "<br />";

// escape
$start = '3 o\'clock';
echo $start; 
echo "<br />";

// \n で改行はできるが、ブラウザには表示されない
$days = "a\nb\nc";
echo $days;
echo "<br />";

// variable interpolation
$name = "くろろ";
echo "Hello $name";
echo "<br />";

// 変数名がどこで終わるかが不明な場合、{}で囲む
echo "Hello {$name}andきりん";
echo "<br />";

// ' では効かない
echo 'Hello $name';
echo "<br />";

// constants
define("GREETING", "Hello Everyone");
echo GREETING;