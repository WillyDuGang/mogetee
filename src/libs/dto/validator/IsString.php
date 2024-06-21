<?php

namespace src\libs\dto\validator;

class IsString extends Validator
{
    public function verify(mixed $data): bool
    {
        return !empty($data) && is_string($data);
    }


}