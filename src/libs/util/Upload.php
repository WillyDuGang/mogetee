<?php

namespace src\libs\util;

class Upload
{

    public const UPLOAD_PATH = 'uploads/';
    public const ACTUALITY = 'actuality';
    public const PROFILE_PICTURE = 'profile-picture';

    public static function newFile(array $file, string $type, string $newFileName): string
    {
        $destination = self::UPLOAD_PATH . $type . '/' . $newFileName;
        move_uploaded_file($file['tmp_name'], $destination);
        return $newFileName;
    }

    public static function removeFile(string $type, string $newFileName){
        @unlink(self::UPLOAD_PATH . $type . '/' . $newFileName);
    }

    public static function generateUniqueFileName(array $file): string
    {
        $randomString = uniqid(pathinfo($file['name'], PATHINFO_FILENAME) . '-');
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        return $randomString . '.' . $extension;
    }
}