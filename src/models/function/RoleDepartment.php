<?php

namespace src\models\function;

use src\models\BaseModel;

class RoleDepartment extends BaseModel
{
    public string $role;
    public string $department;

    public function isEqual(string $role, string $department): bool
    {
        return $this->role === $role && $this->department === $department;
    }
}