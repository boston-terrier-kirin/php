<?php
require_once "../../config/config.php";

spl_autoload_register(function($className) {
    require_once APPROOT . "/app/" . $className . ".php";
});

// function errorHandler($level, $message, $file, $line) {
//     error_log("message: " . $message . " file: " . $file . " line: " . $line);
//     throw new ErrorException($message, 0, $level, $file, $line);
// }
// set_error_handler("errorHandler");

// function exceptionHandler($exception) {
//     error_log($exception->getMessage());
//     Util::redirect("/error/error");
// }
// set_exception_handler("exceptionHandler");

session_start();