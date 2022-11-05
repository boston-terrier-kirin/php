<?php

echo date("d");
echo "<br />-----<br />";

echo date("m");
echo "<br />-----<br />";

echo date("y");
echo "<br />-----<br />";

echo date("Y");
echo "<br />-----<br />";

echo date("Y/m/d");
echo "<br />-----<br />";

echo date("Y/m/d h:i:s");
echo "<br />-----<br />";

// Time Zone
date_default_timezone_set("Asia/Tokyo");
echo date("Y/m/d h:i:s");
echo "<br />-----<br />";

$timestamp = strtotime("2022/11/05");
echo date("Y/m/d h:i:s", $timestamp);
