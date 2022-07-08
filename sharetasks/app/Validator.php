<?php
class Validator {
    public static function validate($columnDef, $data) {
        $errors = [];
        foreach($columnDef as $key => $def) {
            $value = $data[$key];
            $name = $def["name"];

            if (isset($def["required"])) {
                $required = $def["required"];
                if ($required) {
                    if (empty($value) || is_null($value)) {
                        $errors[$key] = $name . "は必須入力です。";
                    }
                }
            }
        }

        return $errors;
    }
}