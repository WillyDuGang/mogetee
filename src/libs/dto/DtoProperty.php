<?php

namespace src\libs\dto;

use src\libs\dto\validator\Validator;

class DtoProperty
{
    private string $name;
    private array $validators = [];
    private bool $isRequired = false;

    /**
     * @param string $name
     * @param Validator[] $validators
     * @param bool $isRequired
     */
    public function __construct(
        string $name,
        array  $validators = [],
        bool $isRequired = false
    )
    {
        $this->isRequired = $isRequired;
        $this->validators = $validators;
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Validator[]
     */
    public function getValidators(): array
    {
        return $this->validators;
    }

    public function isRequired(): bool
    {
        return $this->isRequired;
    }


}