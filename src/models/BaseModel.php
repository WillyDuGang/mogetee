<?php

namespace src\models;

abstract class BaseModel
{
    public function __construct(array $object = [])
    {
        if (!empty($object)){
            $reflect = new \ReflectionClass($this);
            $properties = $reflect->getProperties();
            foreach ($properties as $property) {
                $propertyName = $property->getName();
                $this->{$propertyName} = $object[$propertyName] ?? null;
            }
        }
    }
}