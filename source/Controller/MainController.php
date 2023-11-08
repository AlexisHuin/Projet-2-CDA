<?php

namespace Controller;

use Model\DbModel;
use Model\NotificationsModel;

use Controller\ExceptionHandler;
use Controller\ViewController;
use Controller\SessionController;
use Model\PanierModel;

class MainController
{

    static function Route($routes): void
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
                // ExceptionHandler::RouteErrors('404', '404 Not Found', $_SERVER['REQUEST_URI']);
                header('Location: /');
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
        if (isset($_SESSION['user']) && $_SESSION['user']['RoleUser'] === "Adherent" && !isset($_SESSION["panier"])) {   
            $panier = new PanierModel();
            $panier->IdAdherentsPanier = $_SESSION['user']['IdRole'];
            $results = $panier->Find();
            if($results){ 
                foreach($results as $result){
                    $Ligne = [
                        "IdLigne" => $result['IdPanier'],
                        "Produit" => $result['ProduitPanier'],
                        "Quantite" => $result['QuantitePanier'],
                        "Prix" => $result['PrixPanier']
                    ];
                    $LignePanier[] = $Ligne;
                }
            } else {
                $LignePanier = [];
            }

            SessionController::Set("panier", $LignePanier);
            SessionController::Save();
        }

        $NotificationsModel = new NotificationsModel();

        if (isset($_POST['Read'])) {
            $NotificationsModel->IsReadNotification = 1;
            $NotificationsModel->Where($_POST['Id']);

            $NotificationsModel->Update();

            header('Refresh:0.01;' . $_SERVER['REQUEST_URI']);
            exit();
        }

        if (isset($_SESSION['user'])) {
            $NotificationsModel->IdDestinataireNotification = $_SESSION['user']['IdRole'];
            $NotificationsModel->IsReadNotification = 0;
            $notifications = $NotificationsModel->Find();
        } else {
            $notifications = [];
        }

        ViewController::Init('smarty');
        ViewController::Set('notifications', $notifications);
    }

    protected function connectCheck(string $session, string $role = "", string $Location = "/"): bool
    {
        if (!empty($role)) {
            if (!isset($_SESSION[$session]) && $_SESSION[$session]['RoleUser'] !== $role) {
                header('Location: ' . $Location);
                exit();
            } else {
                return true;
            }
        } else {
            if (!isset($_SESSION[$session])) {
                header('Location: ' . $Location);

                exit();
            } else {
                return true;
            }
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
