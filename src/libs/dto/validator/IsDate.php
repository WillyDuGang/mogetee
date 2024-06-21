<?php

namespace src\libs\dto\validator;

class IsDate extends Validator
{

    public function verify(mixed $data): bool
    {
        if (!is_string($data)) return false;
        $timestamp = strtotime($data);
        return $timestamp !== false && $timestamp !== -1;
    }
}