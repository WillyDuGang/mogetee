<?php

namespace src\libs\alert;

use src\core\View;

class Alert
{
    private const KEY = 'alert';

    public static function setAlert(array $messages, bool $isError): void{
        $_SESSION[self::KEY] = [
          'isError' => $isError,
          'messages' => $messages
        ];
    }
    public static function renderAlert(): void
    {
        if (isset($_SESSION[self::KEY])){
            View::renderFile('components/alert.inc', $_SESSION[self::KEY]);
            unset($_SESSION[self::KEY]);
        }
    }
}