<?php

namespace src\libs\dto\validator;

class IsArray extends Validator
{
    public function verify(mixed $data): bool
    {
        return is_array($data);
    }


}