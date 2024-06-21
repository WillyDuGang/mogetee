<?php

namespace src\libs\middleware;

interface Middleware
{
    public function before(): void;
}