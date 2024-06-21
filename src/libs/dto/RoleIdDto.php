<?php

namespace src\libs\dto;

use src\libs\dto\validator\IsEmail;
use src\libs\dto\validator\IsNumeric;

class RoleIdDto extends BaseDto
{

    /**
     * @return DtoProperty[]
     */
    protected function createDto(): array
    {
        return [
            new DtoProperty(
                'roleID',
                [new IsNumeric('roleID doit être un nombre.')],
                true
            )];
    }
}