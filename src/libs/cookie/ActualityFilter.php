<?php

namespace src\libs\cookie;

class ActualityFilter
{
    private const KEY = 'actuality-filter-by-';
    public const DEPARTMENT = 'department';
    public const KEYWORDS = 'keywords';

    public static function setFilter(string $type, string $value): void{
        setcookie(self::KEY . $type, htmlspecialchars($value), time() + (3600*24*30), COOKIE_PATH);
    }

    public static function getFilter(string $type): ?string
    {
        return $_COOKIE[self::KEY . $type] ?? null;
    }

    public static function removeFilter(string $type): void{
        if (self::getFilter($type) !== null){
            setcookie(self::KEY . $type, "", time() - 3600, COOKIE_PATH);
        }
    }

}