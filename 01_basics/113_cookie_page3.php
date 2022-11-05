<?php
setcookie("name", null, time() - 3600);
setcookie("email", null, time() - 3600);

header("Location: 111_cookie.php");