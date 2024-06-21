<?php

namespace src\libs\dto;

use src\libs\dto\validator\IsNumeric;
use src\libs\dto\validator\IsString;
use src\libs\dto\validator\MinLength;

class EditPasswordDto extends BaseDto
{
    /**
     * @return array|DtoProperty[]
     */
    protected function createDto(): array
    {
        return [
            new DtoProperty(
                'staffID',
                [new IsNumeric('staffID doit être un nombre.')],
                true
            ),
            new DtoProperty('password', [
                new IsString('Le mot de passe doit être une chaîne de caractère.'),
                new MinLength('Le mot de passe doit contenir au minimum 8 caractères.', 8)
            ], true),
            new DtoProperty('passwordRepetition', [
                new IsString('La répétition du mot de passe doit être une chaîne de caractère.'),
                new MinLength('La répétition du mot de passe doit contenir au minimum 8 caractères.', 8)
            ], true)
        ];
    }
}