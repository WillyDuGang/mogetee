<?php

namespace src\libs\dto;

use src\libs\dto\validator\IsArray;
use src\libs\dto\validator\IsEmail;
use src\libs\dto\validator\IsImageFile;
use src\libs\dto\validator\IsNumeric;
use src\libs\dto\validator\IsString;
use src\libs\dto\validator\MinLength;

class AddUserDto extends BaseDto
{
    protected function createDto(): array
    {
        return [
            new DtoProperty('firstname',
                [new IsString('Le prénom doit être une chaîne de caractères')],
            true
            ),
            new DtoProperty('lastname',
                [new IsString('Le nom doit être une chaîne de caractères')],
            true
            ),
            new DtoProperty('email',
                [new IsEmail()],
            true
            ),
            new DtoProperty('phone',
                [new IsNumeric('Le numéro de téléphone doit être numérique')],
                false
            ),
            new DtoProperty('description',
                [new IsString('La description doit être une chaîne de caractères')],
                false
            ),
            new DtoProperty('image',
                [new IsImageFile('Vous devez rentrer une image valide')],
            false
            ),
            new DtoProperty('departments_roles',
                [new IsArray('Vous devez rentrer une image valide')],
            true
            ),
            new DtoProperty('password', [
                new IsString('Le mot de passe doit être une chaîne de caractère.'),
                new MinLength('Le mot de passe doit contenir au minimum 8 caractères.', 8)
            ], true),
            new DtoProperty('passwordRepetition', [
                new IsString('La répétition du mot de passe doit être une chaîne de caractère.'),
                new MinLength('La répétition du mot de passe doit contenir au minimum 8 caractères.', 8)
            ], true)

        ];
    }
}