<?php

namespace src\libs\dto;

use src\libs\dto\validator\IsEmail;
use src\libs\dto\validator\IsNumeric;

class StaffIdDto extends BaseDto
{

    /**
     * @return DtoProperty[]
     */
    protected function createDto(): array
    {
        return [
            new DtoProperty(
            'staffID',
            [new IsNumeric('staffID doit être un nombre.')],
            true
        )];
    }
}