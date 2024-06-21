<?php

namespace src\libs\dto\validator;

class IsImageFile extends Validator
{
    public function verify(mixed $data): bool
    {
        if (!is_array($data)) {
            return false;
        }
        $supportedImageTypes = ['image/png', 'image/jpeg', 'image/gif', 'image/bmp', 'image/webp'];
        if (isset($data['type']) && in_array($data['type'], $supportedImageTypes)) {
            return true;
        }
        return false;
    }
}