<?php

namespace src\models\actuality;

use src\libs\util\Upload;
use src\models\BaseModel;

class LightActuality extends BaseModel
{
    public int $id_actuality;
    public string $date;
    public string $subject;
    public string $image;
    public string $introduction;
    public bool $is_visible;

    public function getDate(): string{
        $timestamp = strtotime($this->date);
        return strftime("%e %B %G", $timestamp);
    }

    public function getImageUrl(): string{
        return Upload::UPLOAD_PATH . Upload::ACTUALITY . '/' . $this->image;
    }
}