<?php

namespace src\libs\dto;

use src\libs\dto\validator\IsEmail;
use src\libs\dto\validator\IsString;
use src\libs\dto\validator\MinLength;

class LoginDto extends BaseDto
{
    /**
     * @return array|DtoProperty[]
     */
    protected function createDto(): array
    {
        return [
            new DtoProperty('email', [new IsEmail()], true),
            new DtoProperty('password', [
                new IsString('Le mot de passe doit être une chaîne de caractère.'),
                new MinLength('Le mot de passe doit contenir au minimum 8 caractères.', 8)
            ], true)
        ];
    }
}