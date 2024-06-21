<?php

namespace src\models\department;

use src\libs\dto\DepartmentIdDto;
use src\libs\dto\NameDto;
use src\libs\dto\UpdateDepartmentDto;
use src\models\BaseRepository;
use PDO;

class DepartmentRepository extends BaseRepository
{
    public const TABLE_NAME = 'department';

    /**
     * @return Department[]
     */
    public function getAllDepartment(): array{
        $stmt = $this->query(
            'SELECT * FROM '. self::TABLE_NAME
        );
        return $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Department::class);
    }


    public function addDepartment(NameDto $addRoleDto): bool{
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

    public function updateDepartment(UpdateDepartmentDto $updateRoleDto): bool{
        $stmt = $this->prepare('
              UPDATE ' . self::TABLE_NAME . ' 
              SET name = :name 
              WHERE id_department = :id_department
        ');
        $stmt->bindValue(':name', $updateRoleDto->get('name'));
        $stmt->bindValue(':id_department', $updateRoleDto->get('departmentID'));
        return $stmt->execute() && $stmt->rowCount() > 0;
    }

    public function delDepartment(DepartmentIdDto $roleIdDto): int{
        $stmt = $this->prepare('
            DELETE FROM '. self::TABLE_NAME .'
            WHERE id_department = :id_department
        ');
        $stmt->bindValue(':id_department', $roleIdDto->get('departmentID'));
        try {
            return ($stmt->execute() && $stmt->rowCount() > 0) ? 1 : 0;
        } catch (\PDOException $exeption){}
        return -1;
    }
}