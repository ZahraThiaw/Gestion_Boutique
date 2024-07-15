<?php

// namespace App\Core;

// use App\App\Controller\ErrorController;
// use ReflectionFunction;
// use ReflectionClass;

// class Route {
//     private static $instance = null;
//     private $routes = [];

//     private function __construct() {}

//     public static function getInstance() {
//         if (self::$instance === null) {
//             self::$instance = new self();
//         }
//         return self::$instance;
//     }

//     public function get($uri, $callback) {
//         $this->routes['GET'][$this->normalizeUri($uri)] = $callback;
//     }

//     public function post($uri, $callback) {
//         $this->routes['POST'][$this->normalizeUri($uri)] = $callback;
//     }

//     private function normalizeUri($uri) {
//         return trim(preg_replace('#/+#', '/', $uri), '/');
//     }

//     public function dispatch() {
//         $method = $_SERVER['REQUEST_METHOD'];
//         $uri = $this->normalizeUri($_SERVER['REQUEST_URI']);

//         if (isset($this->routes[$method][$uri])) {
//             $callback = $this->routes[$method][$uri];

//             if (is_callable($callback)) {
//                 $this->invokeCallback($callback);
//             } else {
//                 $controllerClass = "App\\App\\Controller\\{$callback['controller']}";
//                 $action = $callback['action'];

//                 if (!$this->invokeControllerAction($controllerClass, $action)) {
//                     ErrorController::error();
//                 }
//             }
//         } else {
//             ErrorController::error();
//         }
//     }

//     private function invokeCallback($callback) {
//         $reflectionFunction = new ReflectionFunction($callback);
//         $reflectionFunction->invoke();
//     }

//     private function invokeControllerAction($controllerClass, $action, $params = []) {
//         $reflectionClass = new ReflectionClass($controllerClass);

//         if (!$reflectionClass->isInstantiable()) {
//             return false;
//         }

//         if (!$reflectionClass->hasMethod($action)) {
//             return false;
//         }

//         $reflectionMethod = $reflectionClass->getMethod($action);

//         if (!$reflectionMethod->isPublic() || $reflectionMethod->isStatic()) {
//             return false;
//         }

//         $controllerInstance = $reflectionClass->newInstance();
//         $reflectionMethod->invokeArgs($controllerInstance, $params);
//         return true;
//     }
// }






namespace App\Core;

use App\App\Controller\ErrorController;
use ReflectionFunction;
use ReflectionClass;

class Route {
    private static $instance = null;
    private $routes = [];

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get($uri, $callback) {
        $this->routes['GET'][$this->normalizeUri($uri)] = $callback;
    }

    public function post($uri, $callback) {
        $this->routes['POST'][$this->normalizeUri($uri)] = $callback;
    }

    private function normalizeUri($uri) {
        return trim(preg_replace('#/+#', '/', $uri), '/');
    }

    
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $this->normalizeUri($_SERVER['REQUEST_URI']);

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $routeUri => $callback) {
                $routePattern = preg_replace('#\#\w+#', '(\w+)', $this->normalizeUri($routeUri));
                $routePattern = "#^$routePattern$#";
                if (preg_match($routePattern, $uri, $matches)) {
                    array_shift($matches);
                    if (is_callable($callback)) {
                        $this->invokeCallback($callback, $matches);
                    } else {
                        $controllerClass = "App\\App\\Controller\\{$callback['controller']}";
                        $action = $callback['action'];

                        if (!$this->invokeControllerAction($controllerClass, $action, $matches)) {
                            //ErrorController::error();
                        }
                    }
                    return;
                }
            }
        }
        //ErrorController::error();
    }

    private function invokeCallback($callback, $params) {
        $reflectionFunction = new ReflectionFunction($callback);
        $reflectionFunction->invokeArgs($params);
    }

    private function invokeControllerAction($controllerClass, $action, $params = []) {
        $reflectionClass = new ReflectionClass($controllerClass);

        if (!$reflectionClass->isInstantiable()) {
            return false;
        }

        if (!$reflectionClass->hasMethod($action)) {
            return false;
        }

        $reflectionMethod = $reflectionClass->getMethod($action);

        if (!$reflectionMethod->isPublic() || $reflectionMethod->isStatic()) {
            return false;
        }

        $controllerInstance = $reflectionClass->newInstance();
        $reflectionMethod->invokeArgs($controllerInstance, $params);
        return true;
    }



    // public static function dispatch() {
    //     $method = $_SERVER['REQUEST_METHOD'];
    //     $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'); // Récupère le chemin d'URI sans les barres obliques initiales et finales

    //     // Normalisation de l'URI pour gérer les barres obliques multiples
    //     $uri = preg_replace('#/{2,}#', '/', $uri);

    //     // Parcourir les routes définies
    //     foreach (self::$routes[$method] as $routeUri => $route) {
    //         // Convertir les routes avec paramètres en expressions régulières
    //         $pattern = preg_replace('@\{[^\}]+\}@', '([^/]+)', $routeUri);
    //         if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
    //             array_shift($matches); // Enlever le premier élément qui est la chaîne entière correspondante
    //             self::invokeController($route, $matches);
    //             return;
    //         }
    //     }
    //     ErrorController::error404();
    // }

}


