<?php

namespace src\models;

use PDO;
use src\core\Database;

abstract class BaseRepository extends Database
{
    protected function prepare(string $query): bool|\PDOStatement
    {
        return self::getConnection()->prepare($query);
    }

    protected function query(string $query): bool|\PDOStatement
    {
        return self::getConnection()->query($query);
    }
}