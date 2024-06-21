<?php

namespace src\core;

use src\models\staff\Staff;
use src\models\staff\StaffRepository;

class Auth
{
    private static Staff $staff;

    public static function setSession(Staff $staff): void
    {
        self::$staff = $staff;
        $_SESSION['staffId'] = $staff->id_staff;
    }

    public static function removeSession(): void {
        unset($_SESSION['staffId']);
    }

    public static function getStaff(): ?Staff
    {
        if (isset(self::$staff)) return self::$staff;
        if (!isset($_SESSION['staffId'])) return null;

        $staffRepository = new StaffRepository();
        $staff = $staffRepository->getStaffById($_SESSION['staffId']);
        self::$staff = $staff;
        return $staff;
    }

    public static function isAuth(): bool
    {
        return (bool) self::getStaff();
    }

    public static function isAdmin(): bool
    {
        return (bool) self::getStaff()?->is_admin;
    }
}