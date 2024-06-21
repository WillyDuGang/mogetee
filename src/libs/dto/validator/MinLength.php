<?php

namespace src\libs\dto\validator;

class MinLength extends Validator
{

    private int $min;

    public function __construct(
        string $message,
        int $min
    )
    {
        $this->min = $min;
        parent::__construct($message);
    }


    public function verify(mixed $data): bool
    {
        if (!is_string($data)) return false;
        return $this->min <= strlen($data);
    }
}