<?php

namespace src\libs\util;

class ArrayUtil
{
    /**
     * @param array $array
     * @param callable $callback
     * @return bool
     */
    public static function any(array $array, callable $callback): bool
    {
        return count(array_filter($array, $callback)) > 0;
    }

    public static function findOneInArray(array $array, callable $callback): mixed {
        foreach ($array as $key => $value) {
            if (call_user_func($callback, $value)) {
                return $value;
            }
        }
        return null;
    }

    public static function is2DArray($array): bool {
        if (!is_array($array)) return false;
        foreach ($array as $element) {
            if (is_array($element)) {
                return true;
            }
        }
        return false;
    }
}