<?php

namespace src\libs\dto\validator;

class IsNumeric extends Validator
{
    public function verify(mixed $data): bool
    {
        return is_numeric($data);
    }


}