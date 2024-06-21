<?php

namespace src\models\staff;

use src\models\BaseModel;

class Staff extends LightStaff
{
    public string $email;
    public ?string $phone_number = null;
    public ?string $description = null;
    public bool $is_admin;



}



