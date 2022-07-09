<?php
class Util {
    // Tを削除すると、エラー発生時など再表示時に値が消えてしまう。
    // 消えてしまうというか、value属性には入っているが、HTMLに表示されない。
    // edit-article.phpの初期値も同様に、DBから取得した値はHTMLに表示されない。
    // →表示時に date('Y-m-d\TH:i', strtotime($publishedAt)) することで解決
    public static function convertDateTimeToDbFormat($datetime) {
        if (!$datetime) {
            return $datetime;
        }

        return str_replace("T", " ", $datetime);
    }

    /**
     * https://taroosg.io/trap-of-datetime-local
     * 
     * 空白の場合、strtotimeすると、1970/1/1 になってしまうのを防ぐ。
     */
    public static function covertDateTimeToHtmlFormat($datetime) {
        if ($datetime != "") {
            return date('Y-m-d\TH:i', strtotime($datetime));
        }
        return $datetime;
    }

    public static function redirect($url) {
        $redirectTo = URLROOT . $url;
        header("Location: $redirectTo", true, 307);
        exit;
    }

    public static function registerMessage($message) {
        $messages = [];
        if (!empty($_SESSION["SUCCESS_MESSAGE"])) {
            $messages = $_SESSION["SUCCESS_MESSAGE"];
        }
        $messages[] = $message;

        $_SESSION["SUCCESS_MESSAGE"] = $messages;
    }

    public static function registerErrorMessage($message) {
        $errors = [];
        if (!empty($_SESSION["ERROR_MESSAGE"])) {
            $errors = $_SESSION["ERROR_MESSAGE"];
        }
        $errors[] = $message;

        $_SESSION["ERROR_MESSAGE"] = $errors;
    }

    public static function escape($value) {
        // PHP8からhtmlspecialcharsにnullを渡すと警告が出てしまうので、ここでチェックする。
        if (is_null($value)) {
            return "";
        }

        return htmlspecialchars($value);
    }
}
