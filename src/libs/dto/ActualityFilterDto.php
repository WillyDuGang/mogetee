<?php

namespace src\libs\dto;

use src\libs\dto\validator\IsNumeric;
use src\libs\dto\validator\IsString;
use src\libs\dto\validator\MinLength;
use src\libs\dto\validator\MinLengthInExplodedString;

class ActualityFilterDto extends BaseDto
{
    protected function createDto(): array
    {
        return [
            new DtoProperty(
                'keywords',
                [
                    new IsString('search doit être une chaîne de caractère'),
                    new MinLength('Les mots-cléfs doivent faire minimum 4 caractères', 4),
                    new MinLengthInExplodedString('Vous devez au moins avoir un mot-cléf avec minimum 4 caractères', 4)
                ],
            ),
            new DtoProperty(
                'department',
                [new IsNumeric('department doit être un nombre')]
            )
        ];
    }
}