<?php

namespace src\libs\dto;

use src\libs\dto\validator\IsDate;
use src\libs\dto\validator\IsImageFile;
use src\libs\dto\validator\IsNumeric;
use src\libs\dto\validator\IsString;

class AddActualityDto extends BaseDto
{
    protected function createDto(): array
    {
        return [
            new DtoProperty(
                'date',
                [new IsDate('Vous devez rentrer une date valide')],
                false
            ),
            new DtoProperty(
                'subject',
                [new IsString("Vous devez rentrer une chaîne de caractère pour l'intitulé.")],
                true
            ),
            new DtoProperty(
                'image',
                [new IsImageFile('Vous devez rentrer une image valide')],
                true
            ),
            new DtoProperty(
                'introduction',
                [new IsString("Vous devez rentrer une chaîne de caractère pour l'amorce.")],
                true
            ),
            new DtoProperty(
                'body',
                [new IsString('Vous devez rentrer une chaîne de caractère pour le texte complet')],
                true
            ),
            new DtoProperty(
                'department',
                [new IsNumeric('department doit être un nombre')],
                false
            ),
            new DtoProperty(
                'isVisible',
                [],
                true
            ),
        ];
    }
}