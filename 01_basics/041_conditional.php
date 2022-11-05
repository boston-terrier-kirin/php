<?php

echo "■■■■■■ 5 vs '5.0' <br />";
if (5 == '5') {
    echo "5 == '5': true";
    echo "<br />-----<br />";
}

if (5 === '5') {
    echo "5 === '5': true";
} else {
    echo "5 === '5': false";
}
echo "<br />-----<br />";

if (5 == '5.0') {
    echo "5 == '5.0': true";
} else {
    echo "5 == '5.0': false";
}
echo "<br />-----<br />";

if (5 === 5.0) {
    echo "5 === 5.0: true";
} else {
    echo "5 === 5.0: false ★意外!!★";
}
echo "<br />-----<br /><br />";


echo "■■■■■■ 1 vs bool <br />";
if (1 == True) {
    echo "1 == True: true";
    echo "<br />-----<br />";
}

if (1 === True) {
    echo "1 === True: true";
} else {
    echo "1 === True: false";
}
echo "<br />-----<br /><br />";


echo "■■■■■■ [] vs bool <br />";
if ([] == false) {
    echo "[] == false: true";
    echo "<br />-----<br />";
}

if ([] === false) {
    echo "[] === false: true";
} else {
    echo "[] === false: false  ★jsと同じ★";
}
echo "<br />-----<br />";

