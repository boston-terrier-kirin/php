<?php
session_start();
session_destroy();

header("Location: 101_session.php");