<?php

// functionはhoistingされているもよう
simpleFunction();
echo "<br />-----<br />";

echo sayHello("Kuroro");
echo "<br />-----<br />";

echo sayHello2();
echo "<br />-----<br />";

$myNum = 10;
addFive($myNum);
echo $myNum;
echo "<br />-----<br />";

function simpleFunction() {
    echo "Hello World";
}

function sayHello($name) {
    return "Hello $name";
}

// デフォルトパラメータあり
function sayHello2($name = "World") {
    return "Hello $name";
}

// by ref
function addFive(&$num) {
    // &をつけると参照渡しになる
    $num += 5;
}