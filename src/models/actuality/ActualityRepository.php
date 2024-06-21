<?php

namespace src\models\actuality;

use PDO;
use src\core\Auth;
use src\core\Database;
use src\libs\dto\AddActualityDto;
use src\libs\dto\EditActualityDto;
use src\models\BaseRepository;
use src\models\department\DepartmentRepository;

class ActualityRepository extends BaseRepository
{
    public const TABLE_NAME = 'actuality';

    /**
     * @return LightActuality[]
     */
    public function getAllActualities(string $keywords = null, int $departmentId = null): array
    {
        $isAuth = Auth::isAuth();
        $where = $isAuth ? '' : ' AND a.is_visible = 1';
        $params = [];

        if ($departmentId !== null) {
            $where .= ' AND a.fk_department = :departmentId';
            $params[':departmentId'] = $departmentId;
        }

        if ($keywords !== null) {
            $explodeKeywords = explode(' ', $keywords);
            $explodeKeywords = [...array_filter($explodeKeywords, function($keyword) {
                return 4 <= strlen($keyword);
            })];
            $explodeKeywordsCount = count($explodeKeywords);
            foreach ($explodeKeywords as $index => $keyword) {
                $where .= $index === 0 ? ' AND (' : ' OR ';
                $keyword = '%' . $keyword . '%';
                $where .= '(LOWER(a.subject) LIKE :keyword' . $index . ' OR LOWER(a.body) LIKE :keyword' . $index . ')';
                $where .= $index === ($explodeKeywordsCount - 1) ? ')' : '';
                $params[':keyword' . $index] = $keyword;

            }
        }
        $stmt = $this->prepare('
            SELECT
                a.id_actuality,
                a.date,
                a.subject,
                a.image,
                a.introduction,
                a.is_visible
            FROM ' . self::TABLE_NAME . ' a
            LEFT OUTER JOIN ' . DepartmentRepository::TABLE_NAME . ' d ON d.id_department = a.fk_department  
            WHERE 1 = 1 ' . $where . '
            ORDER BY a.date DESC, a.id_actuality DESC     
        ');

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, LightActuality::class);
    }


    /**
     * @return LightActuality[]
     */
    public function get2LatestActualities(): array
    {
        $stmt = $this->query('
            SELECT
                id_actuality,
                date,
                subject,
                image,
                introduction,
                 is_visible
            FROM ' . self::TABLE_NAME . '
            WHERE is_visible = 1
            ORDER BY date DESC, id_actuality DESC     
            LIMIT 2
        ');
        return $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, LightActuality::class);
    }

    public function getActualityById(int $id): null|FullActuality
    {
        $isAuth = Auth::isAuth();
        $where = $isAuth ? '' : 'AND is_visible = 1';
        $stmt = $this->prepare('
            SELECT
                id_actuality,
                date,
                subject,
                image,
                introduction,
                is_visible,
                body,
                d.name as department
            FROM ' . self::TABLE_NAME . ' a
            LEFT OUTER JOIN ' . DepartmentRepository::TABLE_NAME . ' d ON d.id_department = a.fk_department  
            WHERE id_actuality = :id_actuality ' . $where . '  
        ');
        $stmt->bindValue(':id_actuality', $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, FullActuality::class);
        $stmt->execute();
        $actuality = $stmt->fetch();
        if (!$actuality) return null;
        return $actuality;
    }

    public function delActualityById(int $id): bool{
        $stmt = $this->prepare('
            DELETE FROM '. self::TABLE_NAME .'
            WHERE id_actuality = :id_actuality
        ');
        $stmt->bindValue('id_actuality', $id);
        return $stmt->execute() && $stmt->rowCount() > 0;
    }

    public function addActuality(AddActualityDto $addActualityDto, string $imageName): false|int{
        $stmt = $this->prepare('
            INSERT INTO ' . self::TABLE_NAME . ' (date, subject, image, introduction, body, is_visible, fk_department)
            VALUES (:date, :subject, :image, :introduction, :body, :is_visible, :fk_department)
        ');
        $stmt->bindValue(':date', $addActualityDto->get('date'));
        $stmt->bindValue(':subject', $addActualityDto->get('subject'));
        $stmt->bindValue(':image', $imageName);
        $stmt->bindValue(':introduction', $addActualityDto->get('introduction'));
        $stmt->bindValue(':body', $addActualityDto->get('body'));
        $stmt->bindValue(':is_visible', $addActualityDto->get('isVisible'));
        $stmt->bindValue(':fk_department', $addActualityDto->get('department'));
        try {
            $stmt->execute();
        } catch (\PDOException $exception){
            return false;
        }
        return Database::getConnection()->lastInsertId();
    }

    public function updateActuality(EditActualityDto $editActualityDto, ?string $imageName = null): bool{
        $setImage = $imageName === null ? '' : ', image = :image';
        $stmt = $this->prepare('
            UPDATE ' . self::TABLE_NAME . '
            SET
               date = :date,
               subject = :subject,
               introduction = :introduction,
               body = :body,
               is_visible = :is_visible,
               fk_department = :fk_department
               ' . $setImage . '
            WHERE id_actuality = :id_actuality                                  
        ');
        $stmt->bindValue(':date', $editActualityDto->get('date'));
        $stmt->bindValue(':subject', $editActualityDto->get('subject'));
        $stmt->bindValue(':introduction', $editActualityDto->get('introduction'));
        $stmt->bindValue(':body', $editActualityDto->get('body'));
        $stmt->bindValue(':is_visible', $editActualityDto->get('isVisible'));
        $stmt->bindValue(':fk_department', $editActualityDto->get('department'));
        $stmt->bindValue(':id_actuality', $editActualityDto->get('actualityID'));
        if ($imageName !== null){
            $stmt->bindValue(':image', $imageName);
        }
        return $stmt->execute() && $stmt->rowCount() > 0;
    }
}