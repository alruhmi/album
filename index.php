<?php
/**
 * Created by PhpStorm.
 * User: fahmi
 * Date: 04.10.2020
 * Time: 12:49
 */
require 'vendor/autoload.php';
use App\Core\{Application, Request, Router};
use App\Core\Database\Connection;
use App\Core\Database\QueryBuilder;

Application::bind('config', require 'config.php');

Application::bind('database', new QueryBuilder(
    Connection::make(Application::get('config')['database'])
));

Router::load('app/routes.php')->direct(Request::uri(), Request::method());
