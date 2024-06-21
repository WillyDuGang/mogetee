<?php

namespace src\models\function;

use src\models\staff\LightStaff;

class StaffFunction extends LightStaff
{
    public ?string $role;
    public ?string $department;
}