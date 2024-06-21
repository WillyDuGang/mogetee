<?php

namespace src\libs\dto\validator;

abstract class Validator
{
    private string $message;

    public function __construct(
        string $message
    ){
        $this->message = $message;
    }

    /**
     * @param mixed $data
     * @return bool
     */
    public abstract function verify(mixed $data): bool;

    public function getMessage(): string
    {
        return $this->message;
    }

}