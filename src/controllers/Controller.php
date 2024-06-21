<?php

namespace src\controllers;

use src\core\View;

abstract class Controller
{

    protected string $title;

    protected function setTitle(string $title): void
    {
        $this->title = $title;
    }

    protected function renderPage(string $view, array $data = []): void
    {
        $data['title'] = $this->title;
        View::render($view, $data);
    }

    public function get(): void {}
    public function post(): void {}
    public function patch(): void {}
    public function del(): void {}
    public function put(): void {}


}