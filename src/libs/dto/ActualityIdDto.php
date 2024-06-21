<?php

namespace src\libs\dto;

use src\libs\dto\validator\IsNumeric;

class ActualityIdDto extends BaseDto
{
    protected function createDto(): array
    {
        return [
            new DtoProperty(
                'actualityID',
                [new IsNumeric('actualityID doit être un nombre.')],
                true
            )
        ];
    }
}