<?php

namespace src\models\staff;

use PDO;
use src\core\Database;
use src\libs\dto\AddUserDto;
use src\libs\dto\UpdateStaffDto;
use src\models\BaseRepository;

class StaffRepository extends BaseRepository
{
    public const TABLE_NAME = 'staff';

    public function getStaffByEmail(string $email, bool $getPassword = false): null|Staff|PasswordStaff
    {
        $stmt = $this->prepare('
            SELECT
                id_staff,
                firstname,
                lastname,
                email,
                ' . ($getPassword ? 'password_hash,' : '') . '
                phone_number,
                profile_picture,
                description,
                is_admin
            FROM '. self::TABLE_NAME .' WHERE email = :email;  
        ');
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $staff = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$staff) return null;
        return $getPassword ? new PasswordStaff($staff) : new Staff($staff);
    }

    public function getStaffById(int $id): ?Staff
    {
        $stmt = $this->prepare('
            SELECT
                id_staff,
                firstname,
                lastname,
                email,
                phone_number,
                profile_picture,
                description,
                is_admin
            FROM '. self::TABLE_NAME .' WHERE id_staff = :id_staff;  
        ');
        $stmt->bindValue(':id_staff', $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Staff::class);
        $stmt->execute();
        $staff = $stmt->fetch();
        if (!$staff) return null;
        return $staff;
    }

    public function updateStaffPasswordByEmail(string $email, string $newPassword): bool{
        $stmt = $this->prepare('
                    UPDATE staff 
                    SET password_hash = :newPassword 
                    WHERE email = :email
        ');
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':newPassword', $this->hashPassword($newPassword));
        return $stmt->execute() && $stmt->rowCount() > 0;
    }

    public function updateStaffPasswordByStaffId(int $staffId, string $newPassword): bool{
        $stmt = $this->prepare('
                    UPDATE staff 
                    SET password_hash = :newPassword 
                    WHERE id_staff = :id_staff
        ');
        $stmt->bindValue(':id_staff', $staffId);
        $stmt->bindValue(':newPassword', $this->hashPassword($newPassword));
        return $stmt->execute() && $stmt->rowCount() > 0;
    }

    private function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function updateStaffProfile(UpdateStaffDto $updateStaffDto, ?string $imageName): bool{
        $setImage = $imageName === null ? '' : ', profile_picture = :profile_picture';
        $stmt = $this->prepare('
            UPDATE ' . self::TABLE_NAME . '
            SET
               firstname = :firstname,
               lastname = :lastname,
               email = :email,
               phone_number = :phone_number,
               description = :description
               ' . $setImage . '
            WHERE id_staff = :id_staff                                  
        ');
        $stmt->bindValue(':firstname', $updateStaffDto->get('firstname'));
        $stmt->bindValue(':lastname', $updateStaffDto->get('lastname'));
        $stmt->bindValue(':email', $updateStaffDto->get('email'));
        $stmt->bindValue(':phone_number', $updateStaffDto->get('phone'));
        $stmt->bindValue(':description', $updateStaffDto->get('description'));
        $stmt->bindValue(':id_staff', $updateStaffDto->get('staffID'));
        if ($imageName !== null){
            $stmt->bindValue(':profile_picture', $imageName);
        }
        return $stmt->execute() && $stmt->rowCount() > 0;
    }

    public function addStaff(AddUserDto $addUserDto, ?string $imageName): false|int{
        $stmt = $this->prepare('
            INSERT INTO ' . self::TABLE_NAME . '
             VALUES (
                null,
                :firstname,
                :lastname,
                :email,
                :password_hash,
                :phone_number,
                :profile_picture,
                :description,
                FALSE
             )
        ');
        $stmt->bindValue(':firstname', $addUserDto->get('firstname'));
        $stmt->bindValue(':lastname', $addUserDto->get('lastname'));
        $stmt->bindValue(':email', $addUserDto->get('email'));
        $stmt->bindValue(':password_hash', $this->hashPassword($addUserDto->get('password')));
        $stmt->bindValue(':phone_number', $addUserDto->get('phone'));
        $stmt->bindValue(':description', $addUserDto->get('description'));
        $stmt->bindValue(':profile_picture', $imageName);
        try {
            if($stmt->execute() && $stmt->rowCount() > 0){
                return Database::getConnection()->lastInsertId();
            }
        } catch (\PDOException $exception){}
        return false;
    }

    public function delStaffById(int $staffId): bool{
        $stmt = $this->prepare('
            DELETE FROM '. self::TABLE_NAME .'
            WHERE id_staff = :id_staff
        ');
        $stmt->bindValue('id_staff', $staffId);
        return $stmt->execute() && $stmt->rowCount() > 0;
    }
}