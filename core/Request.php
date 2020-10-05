<?php
/**
 * Created by PhpStorm.
 * User: fahmi
 * Date: 04.10.2020
 * Time: 14:08
 */

namespace App\Core;


class Request
{

    public static function uri()
    {
        return trim(parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

}