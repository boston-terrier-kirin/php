<?php
function errorHandler($level, $message, $file, $line) {
    // これで、exceptionHandler の方に飛ばせる。
    throw new ErrorException($message, 0, $level, $file, $line);
}
set_error_handler("errorHandler");

function exceptionHandler($exception) {
    echo "Catch Exception: " . $exception->getMessage();
}
set_exception_handler("exceptionHandler");
?>