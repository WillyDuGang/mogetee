<?php

namespace src\libs\dto\validator;

class MaxLength extends Validator
{
    private int $max;

    public function __construct(
       string $message,
       int $max
   )
   {
       $this->max = $max;
       parent::__construct($message);
   }


    public function verify(mixed $data): bool
    {
        if (!is_string($data)) return false;
        return $this->max >= strlen($data);
    }
}