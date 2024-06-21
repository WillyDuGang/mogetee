<?php

namespace src\core;

use PDO;
use PDOException;
use src\libs\redirect\Redirect;

class Database
{
    /**
     * @var PDO
     */
    private static PDO $database;

    /**
     * @return PDO
     */
    protected static function getConnection(): PDO
    {
        if (!isset(self::$database)) {
            try {
                self::$database = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
            } catch (PDOException $e) {
                $redirect = new Redirect(null, ['La base de données est inaccessible pour le moment. Veuillez réessayer plus tard.', DB_HOST], true);
                $redirect->goTo();
            }
        }
        return self::$database;
    }
}
