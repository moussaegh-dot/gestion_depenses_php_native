<?php
namespace App\Core;

class Router {
    private array $routes = [];

    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action) 
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if(!isset($this->routes[$method][$uri])) 
        {
            http_response_code(404);
            echo "404 - Page Not found";
            return;
        }

        $callback = $this->routes[$method][$uri];
        // ---------------------------
        // Détection du type de callback
        // ---------------------------
        if(is_array($callback)) 
        {
            //Format : ['Controller', 'method']
            $controller = $callback[0];
            $methodName = $callback[1];
        }
        elseif (is_string($callback) && strpos($callback, '@') !== false)
        {
            //Format: "Controller@method
            list($controller, $methodName) = explode('@', $callback);
        } else {
            throw new \Exception("Invalid route callback format");
        }

         // ---------------------------
        // Ajout namespace si absent
        // ---------------------------
        if(strpos($controller, "App\\Controllers\\") === false)
        {
            $controller = "App\\Controllers\\" . $controller;
        }

        if (!class_exists($controller)) {
            throw new \Exception("Controller $controller not found");
        }
        //Instanciation du controlller
        $controllerInstance = new $controller();

        //Vérifier si la méthode existe
        if(!method_exists($controllerInstance, $methodName))
        {
            throw new \Exception("Method $methodName not found in Controller");
        }
        //-----------------------------------------
        // Exécuter l'action 
        //-----------------------
        $controllerInstance->$methodName();

    }
}