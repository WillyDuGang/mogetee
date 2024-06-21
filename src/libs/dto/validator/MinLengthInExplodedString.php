<?php


namespace src\libs\dto\validator;

class MinLengthInExplodedString extends Validator
{

    private int $min;

    public function __construct(
        string $message,
        int    $min
    )
    {
        $this->min = $min;
        parent::__construct($message);
    }


    public function verify(mixed $data): bool
    {
        if (!is_string($data)) return false;
        $explodedString = explode(' ', $data);
        foreach ($explodedString as $string){
            if ($this->min <= strlen($string)) return true;
        }
        return false;
    }
}