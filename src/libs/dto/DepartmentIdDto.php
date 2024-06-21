<?php

namespace src\libs\dto;

use src\libs\dto\validator\IsEmail;
use src\libs\dto\validator\IsNumeric;

class DepartmentIdDto extends BaseDto
{

    /**
     * @return DtoProperty[]
     */
    protected function createDto(): array
    {
        return [
            new DtoProperty(
                'departmentID',
                [new IsNumeric('departmentID doit être un nombre.')],
                true
            )];
    }
}