<?php

namespace src\libs\dto;

use src\libs\dto\validator\IsEmail;
use src\libs\dto\validator\IsString;
use src\libs\dto\validator\MinLength;

class ContactDto extends BaseDto
{
    /**
     * @return DtoProperty[]
     */
    protected function createDto(): array
    {
        return [
            new DtoProperty('email', [
                new IsString("Vous devez rentrer une chaîne de caractère pour l'email."),
                new IsEmail()
            ], true),
            new DtoProperty(
                'subject',
                [new IsString("Vous devez rentrer une chaîne de caractère pour l'intitulé.")],
                true
            ),
            new DtoProperty(
                'message',
                [new IsString("Vous devez rentrer une chaîne de caractère pour le message.")],
                true
            ),
        ];
    }
}