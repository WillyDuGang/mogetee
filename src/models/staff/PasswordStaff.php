<?php

namespace src\models\staff;

class PasswordStaff extends Staff
{
    public string $password_hash;

    public function toStaff(): Staff{
        $staff = new Staff();
        $staff->id_staff = $this->id_staff;
        $staff->firstname = $this->firstname;
        $staff->lastname = $this->lastname;
        $staff->email = $this->email;
        $staff->phone_number = $this->phone_number;
        $staff->profile_picture = $this->profile_picture;
        $staff->description = $this->description;
        $staff->is_admin = $this->is_admin;
        return $staff;
    }
}