<?php

namespace src\models\role;

use PHPMailer\PHPMailer\Exception;
use src\core\Database;
use src\libs\dto\NameDto;
use src\libs\dto\RoleIdDto;
use src\libs\dto\UpdateRoleDto;
use src\models\BaseRepository;
use PDO;

class RoleRepository extends BaseRepository
{
    public const TABLE_NAME = 'role';


    /**
     * @return Role[]
     */
    public function getAllRole(): array
    {
        $stmt = $this->query('
            SELECT
                id_role,
                name
            FROM ' . self::TABLE_NAME . ' sf
        ');
        return $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Role::class);
    }

    public function addRole(NameDto $addRoleDto): bool{
        $stmt = $this->prepare('
            INSERT INTO '. self::TABLE_NAME .' (name)
            VALUES (:name)
        ');
        $stmt->bindValue(':name', $addRoleDto->get('name'));
        try {
            return  $stmt->execute() && $stmt->rowCount() > 0;
        } catch (\PDOException $exception){}
        return false;
    }

    public function updateRole(UpdateRoleDto $updateRoleDto): bool{
        $stmt = $this->prepare('
              UPDATE ' . self::TABLE_NAME . ' 
              SET name = :name 
              WHERE id_role = :id_role
        ');
        $stmt->bindValue(':name', $updateRoleDto->get('name'));
        $stmt->bindValue(':id_role', $updateRoleDto->get('roleID'));
        return $stmt->execute() && $stmt->rowCount() > 0;
    }

    public function delRole(RoleIdDto $roleIdDto): int{
        $stmt = $this->prepare('
            DELETE FROM '. self::TABLE_NAME .'
            WHERE id_role = :id_role
        ');
        $stmt->bindValue(':id_role', $roleIdDto->get('roleID'));
        try {
            return ($stmt->execute() && $stmt->rowCount() > 0) ? 1 : 0;
        } catch (\PDOException $exeption){}
        return -1;
    }
}