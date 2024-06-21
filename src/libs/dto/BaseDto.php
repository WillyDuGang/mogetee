<?php

namespace src\libs\dto;

abstract class BaseDto
{
    /**
     * @var DtoProperty[]
     */
    protected array $properties = [];

    /**
     * @var array
     */
    protected array $data;

    /**
     * @var string[]
     */
    private array $errors = [];

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->properties = $this->createDto();
    }

    /**
     * @return DtoProperty[]
     */
    abstract protected function createDto(): array;

    public function isValidDto(): bool
    {
        foreach ($this->properties as $dtoProperty) {
            $name = $dtoProperty->getName();
            if (!$dtoProperty->isRequired() and !isset($this->data[$name])) continue;
            if ($dtoProperty->isRequired() and !isset($this->data[$name])) {
                $this->errors = ["Certains champs requis sont manquants dans les données fournies."];
                return false;
            }
            foreach ($dtoProperty->getValidators() as $validator){
                if (empty($this->data[$name]) && !$dtoProperty->isRequired()) continue;
                if (!$validator->verify($this->data[$name])) {
                    $this->errors[] = $validator->getMessage();
                }
            }
        }
        return empty($this->errors);
    }

    /**
     * @return string[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function get(string $name): mixed
    {
        return $this->data[$name] ?? null;
    }
}