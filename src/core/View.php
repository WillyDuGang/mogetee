<?php

namespace src\core;

use src\libs\alert\Alert;
use src\libs\redirect\Redirect;
use src\libs\util\Format;

class View
{
    public static function render(string $view, array $data = []): void
    {


        self::renderFile("layout/header.inc", $data);
        self::renderFile($view, $data);
        Alert::renderAlert();
        self::renderFile("layout/footer.inc");
    }

    public static function renderFile(string $view, array $data = []): void
    {
        require_once "templates/$view.php";
    }

    public static function redirect(string $location = null, array $messages = [], bool $isError = false): Redirect
    {
        return new Redirect($location, $messages, $isError);
    }

    public static function getMailTemplate(string $file, array $vars): string{
        $templateContent = file_get_contents("templates/mails/$file.txt");
        return Format::replace($templateContent, $vars);
    }
}