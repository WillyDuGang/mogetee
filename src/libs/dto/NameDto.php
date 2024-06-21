<?php

namespace src\libs\dto;

use src\libs\dto\validator\IsNumeric;
use src\libs\dto\validator\IsString;

class NameDto extends BaseDto
{
    protected function createDto(): array
    {
        return [
            new DtoProperty(
                'name',
                [new IsString('Le du rôle doit être une chaîne de caractère.')],
                true
            )
        ];
    }
}