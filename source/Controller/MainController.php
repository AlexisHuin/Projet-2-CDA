<?php

namespace Controller;

//use Controller\Session;
use Model\DbModel;
use Controller\ExceptionHandler;
use Controller\ViewController;
use Controller\SessionController;

class MainController
{
    static function Route($routes)
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) use ($routes) {
            foreach ($routes as $uri => $route) {
                $r->addRoute($route['method'], $uri, $route['controller']);
            }
        });

        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri        = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                ExceptionHandler::RouteErrors('404', '404 Not Found', $_SERVER['REQUEST_URI']);
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                ExceptionHandler::RouteErrors('405', '405 Method Allowed', $_SERVER['REQUEST_URI']);
                break;
            case \FastRoute\Dispatcher::FOUND:
                $handler    = $routeInfo[1];
                $vars       = $routeInfo[2];

                // Si non Static : 
                $handler[0] = new $handler[0];

                call_user_func(
                    $handler,
                    $vars
                );
                break;
        }
    }

    public function __construct()
    {
        SessionController::Start();
        DbModel::Connect();
    }

    protected function connectCheck(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /User/');
            exit();
        }
    }

    // Valide si tous les champs du formulaire sont remplis
    public function validate(array $form, array $champsObligatoires, array $champsFacultatifs = []): array
    {
        $champsCheck = array_merge($champsObligatoires, $champsFacultatifs);

        foreach ($champsCheck as $champObligatoire) {
            if (in_array($champsCheck, $champsObligatoires)) {
                // Si le champ est absent ou vide dans le formulaire
                if (!isset($form[$champObligatoire]) || empty($form[$champObligatoire])) {
                    return false;
                } else {
                    $form[$champObligatoire] = htmlspecialchars(stripslashes(trim($form[$champObligatoire])));
                }
            }
        }
        return $form;
    }

    public function __destruct()
    {
    }

    public function __get($var)
    {
    }

    public function __set($var, $value)
    {
    }

    public function __call($method, $parameters)
    {
    }
}
