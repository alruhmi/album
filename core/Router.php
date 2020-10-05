<?php
/**
 * Created by PhpStorm.
 * User: fahmi
 * Date: 04.10.2020
 * Time: 13:04
 */
namespace App\Core;

class Router
{

    public $routes = [
        'GET' => [],
        'POST' => []
    ];


    public static function load($routesFile)
    {
        $router = new static;

        require $routesFile;

        return $router;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])){
            return $this->callAction(...explode('@', $this->routes[$requestType][$uri]));
        }

        throw new \Exception('No route defined for this uri');
    }

    protected function callAction($controller, $action)
    {
        $controller = "App\\Controllers\\{$controller}";
        $controllerObject = new $controller;

        if (!method_exists($controllerObject,$action)){
            throw new \Exception("{$controllerObject} does not respond to the {$action} action");

        }

        return $controllerObject->$action();
    }

}