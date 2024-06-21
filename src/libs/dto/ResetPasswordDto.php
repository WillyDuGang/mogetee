<?php

namespace src\libs\dto;

use src\libs\dto\validator\IsEmail;
use src\libs\dto\validator\IsString;
use src\libs\dto\validator\MinLength;

class ResetPasswordDto extends BaseDto
{
    /**
     * @return DtoProperty[]
     */
    protected function createDto(): array
    {
        return [new DtoProperty('email', [new IsEmail()], true)];
    }
}