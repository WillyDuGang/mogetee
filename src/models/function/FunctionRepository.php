<?php

namespace src\models\function;

use src\models\BaseRepository;
use src\models\department\DepartmentRepository;
use src\models\role\RoleRepository;
use src\models\staff\StaffRepository;
use PDO;

class FunctionRepository extends BaseRepository
{
    public const TABLE_NAME = 'staff_function';

    /**
     * @return StaffFunction[]
     */
    public function getAllStaffFunction(): array
    {
        $stmt = $this->query('
            SELECT
                id_staff,
                firstname,
                lastname,
                profile_picture,
                d.name AS department,
                r.name AS role
            FROM ' . StaffRepository::TABLE_NAME . ' s
                     LEFT JOIN ' . self::TABLE_NAME . ' sf ON sf.fk_staff = s.id_staff
                     LEFT JOIN ' . DepartmentRepository::TABLE_NAME . ' d ON sf.fk_department = d.id_department
                     LEFT JOIN ' . RoleRepository::TABLE_NAME . ' r ON sf.fk_role = r.id_role
            ORDER BY ISNULL(d.name), d.id_department, s.lastname;
        ');
        return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, StaffFunction::class);
    }

    /**
     * @param int $id
     * @return RoleDepartment[]
     */
    public function getAllRoleDepartmentByStaffId(int $id): array
    {
        $stmt = $this->prepare('
            SELECT
                r.name AS role,
                d.name AS department
            FROM ' . self::TABLE_NAME . ' sf
            JOIN ' . StaffRepository::TABLE_NAME . ' s ON sf.fk_staff = s.id_staff
            JOIN ' . DepartmentRepository::TABLE_NAME . ' d ON sf.fk_department = d.id_department
            JOIN ' . RoleRepository::TABLE_NAME . ' r ON sf.fk_role = r.id_role
            WHERE s.id_staff = :id
        ');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, RoleDepartment::class);
    }

    public function updateStaffFunction(int $staffId, array $departmentsRoles): void
    {
        $this->deleteStaffFunctionByStaffId($staffId);
        $stmt = $this->prepare('
            INSERT INTO staff_function (fk_staff, fk_department, fk_role)
            VALUES (:staffId, :departmentId, :roleId)
        ');
        foreach ($departmentsRoles as $departmentId => $roleId) {
            if (is_numeric($departmentId) && is_numeric($roleId)){
                if (intval($roleId) === -1) continue;
                $stmt->bindValue(':staffId', $staffId);
                $stmt->bindValue(':departmentId', $departmentId);
                $stmt->bindValue(':roleId', $roleId);
                try{
                    $stmt->execute();
                } catch (\PDOException $e){

                }
            }
        }
    }

    private function deleteStaffFunctionByStaffId(int $staffId): void
    {
        $stmt = $this->prepare('DELETE FROM ' . self::TABLE_NAME . ' WHERE fk_staff = :staffId');
        $stmt->bindValue(':staffId', $staffId);
        $stmt->execute();
    }
}