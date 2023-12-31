<?php

namespace Controller;

use Model\DbModel;
use Model\NotificationsModel;

use Controller\ExceptionHandler;
use Controller\ViewController;
use Controller\SessionController;
use Model\PanierModel;
use Model\ProduitProducteurModel;

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

        $noticePrix = $noticeQt = "";

        /* //* Si j'ai le temps, reprendre ce code afin d'avoir un bouton retour fonctionnel en PHP
        if (!isset($_SESSION['history'])) {
            $_SESSION['history'] = [];
        }
        if (strchr($_SERVER['REQUEST_URI'], "?Return") == "?Return") {
            $previousPage = array_pop($_SESSION['history']);

            header('Location:' . $previousPage);
            exit();
        } else {
            if (end($_SESSION['history']) !== $_SERVER['REQUEST_URI'])
                // Ajouter la page actuelle à l'historique
                array_push($_SESSION['history'], $_SERVER['REQUEST_URI']);
        } 
        var_dump($_SESSION['history']);*/

        if (isset($_SESSION['user']) && $_SESSION['user']['RoleUser'] === "Adherent") {
            $this->UpdatePanier();
        }

        $notifications = $this->NotificationHandler();

        ViewController::Init('smarty');
        ViewController::Set('URI', $_SERVER['REQUEST_URI']);
        ViewController::Set("noticeQt", $noticeQt);
        ViewController::Set("noticePrix", $noticePrix);
        ViewController::Set('notifications', $notifications);
    }

    protected function connectCheck(string $session, string $role = "", string $Location = "/", bool $isLogin = false): bool
    {
        if (!empty($role)) {
            if (!isset($_SESSION[$session]) || $_SESSION[$session]['RoleUser'] !== $role) {
                header('Location: ' . $Location);
                exit();
            } else {
                return true;
            }
        } else {
            if ($isLogin) {
                if (isset($_SESSION[$session])) {
                    header('Location:' . $Location);
                    exit();
                } else {
                    return true;
                }
            } else if (!isset($_SESSION[$session])) {
                header('Location:' . $Location);
                exit();
            } else {
                return true;
            }
        }
    }

    // Valide si tous les champs du formulaire sont remplis
    public function validate(array $form, array $champsObligatoires, array $champsFacultatifs = []): array|bool
    {
        $champsCheck = array_merge($champsObligatoires, $champsFacultatifs);
        $datas = [];
        foreach ($champsCheck as $champObligatoire) {
            if (in_array($champObligatoire, $champsObligatoires)) {
                // Si le champ est absent ou vide dans le formulaire
                if (!isset($form[$champObligatoire]) || empty($form[$champObligatoire])) {
                    echo "<pre>";
                    var_dump($form);
                    echo "</pre>";
                    return false;
                }
            }
            if (is_array($form[$champObligatoire])) {
                $keys = array_keys($form[$champObligatoire]);
                $datas[$champObligatoire] = $this->validate($form[$champObligatoire], $keys);
            } else {
                $datas[$champObligatoire] = htmlspecialchars(stripslashes(trim($form[$champObligatoire])));
            }
        }
        return $datas;
    }

    private function UpdatePanier(): void
    {
        $panier = new PanierModel();
        $produitproducteur = new ProduitProducteurModel();

        $panier->IdAdherentsPanier = $_SESSION['user']['IdRole'];
        $results = $panier->Find();
        if ($results) {
            foreach ($results as $result) {
                $produitproducteur->IdProduitProducteur = $result['ProduitPanier'];
                $resultProduitProd = $produitproducteur->Find("*", "Fetch");

                if ($resultProduitProd['PrixProduitProducteur'] != ($result['PrixPanier'] / $result['QuantitePanier'])) {
                    $result['PrixPanier'] = ($resultProduitProd['PrixProduitProducteur'] * $result['QuantitePanier']);

                    $noticePrix = "Le prix de " . $resultProduitProd['DesignationProduitProducteur'] . " a été changé. Le montant total a été recalculé";
                }

                if ($resultProduitProd['QuantiteProduitProducteur'] < $result['QuantitePanier']) {
                    $result['QuantitePanier'] = $resultProduitProd['QuantiteProduitProducteur'];

                    $noticeQt = 'La quantité que vous aviez selectionné pour ' . $resultProduitProd['DesignationProduitProducteur'] . ' n\'est plus disponible et a été adaptée à la nouvelle quantité';
                }

                if (isset($noticePrix) || isset($noticeQt)) {
                    $panier->QuantitePanier = $result['QuantitePanier'];
                    $panier->PrixPanier = $result['PrixPanier'];
                    $panier->Where($result['IdPanier']);
                    $panier->Update();
                }

                $Ligne = [
                    "IdLigne" => $result['IdPanier'],
                    "Produit" => $result['ProduitPanier'],
                    "Quantite" => $result['QuantitePanier'],
                    "Prix" => $result['PrixPanier'],
                    "Producteur" => $result['IdProducteurProduitPanier']
                ];
                $LignePanier[] = $Ligne;
            }
        } else {
            $LignePanier = [];
        }

        SessionController::Set("panier", $LignePanier);
        SessionController::Save();
    }

    private function NotificationHandler(): array|object
    {

        $NotificationsModel = new NotificationsModel();

        if (isset($_POST['Read'])) {
            $NotificationsModel->IsReadNotification = 1;
            $NotificationsModel->Where($_POST['Id']);

            $NotificationsModel->Update();

            header('Location:' . $_SERVER['REQUEST_URI']);
            exit();
        }

        if (isset($_SESSION['user'])) {
            $NotificationsModel->IdDestinataireNotification = $_SESSION['user']['Id'];
            $NotificationsModel->IsReadNotification = 0;
            $notifications = $NotificationsModel->Find();
        } else {
            $notifications = [];
        }

        return $notifications;
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
