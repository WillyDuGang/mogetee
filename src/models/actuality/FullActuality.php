<?php

namespace src\models\actuality;

use src\models\actuality\LightActuality;
class FullActuality extends LightActuality
{
    public string $body;
    public ?string $department = null;

}