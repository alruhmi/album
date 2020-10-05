<?php
/**
 * Created by PhpStorm.
 * User: fahmi
 * Date: 04.10.2020
 * Time: 13:29
 */

namespace App\Core;


class Application
{
    protected static $registry = [];

    public static function bind($key, $value)
    {
        static::$registry[$key] = $value;

    }

    public static function get($key)
    {
        if (!array_key_exists($key, static::$registry)) {
            throw new \Exception("No {$key} is bound in the container.");
        }

        return static::$registry[$key];
    }

}