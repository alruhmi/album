<?php
/**
 * Created by PhpStorm.
 * User: fahmi
 * Date: 04.10.2020
 * Time: 14:00
 */

function view($name, $data = [])
{
    extract($data);

    return require "app/views/{$name}.view.php";
}

function redirect($path)
{
    header("Location: /{$path}");
}

function cleanNumbers($phoneString)
{
    return preg_replace('/[^+0-9]/', '', $phoneString);
}
