<?php

namespace src\models\staff;

use src\libs\util\Upload;
use src\models\BaseModel;

class LightStaff extends BaseModel
{
    public int $id_staff;
    public string $firstname;
    public string $lastname;
    public ?string $profile_picture = null;

    public function getProfilPictureUrl(): string{
        if (!empty($this->profile_picture)){
            return Upload::UPLOAD_PATH . Upload::PROFILE_PICTURE . '/' . $this->profile_picture;
        }
        return 'assets/images/content/default-profile.webp';
    }
}