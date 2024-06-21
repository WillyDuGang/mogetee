<?php

namespace src\libs\dto\validator;

class IsEmail extends Validator
{
    public function __construct()
    {
        parent::__construct("L'adresse e-mail n'est pas valide");
    }

    public function verify(mixed $data): bool
    {
        if (!is_string($data)) return false;
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }
}