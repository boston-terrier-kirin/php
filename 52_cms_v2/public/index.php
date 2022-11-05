<?php
// bootstrap.php経由でincludeするパスがズレるので、個別にincludeする。
require_once("../config/config.php");
require_once("../app/Util.php");

Util::redirect("/user/login");