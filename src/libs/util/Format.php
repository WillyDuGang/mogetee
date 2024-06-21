<?php
namespace src\libs\util;

class Format
{

    public static function formatResponseMessage(string $text): string {
        return str_replace(',', '<br>', $text);
    }

    public static function replace(string $str, array $vars): string
    {
        foreach ($vars as $key => $value) {
            $str = str_replace("{" . $key . "}", $value, $str);
        }
        return $str;
    }
}