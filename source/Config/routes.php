<?php
$routes = [
    '/' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\HomeController','Index']
    ],
    '/DescriptifProduit/{id:\d+}' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\HomeController','DescriptifProduit']
    ],
    '/User' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','ConnexionInscription']
    ],
    '/User/Deconnexion' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','Deconnexion']
    ],
    '/User/Profile' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','Profile']
    ],
    '/User/ProductList' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\ProducteurController','ProductList']
    ],
    '/User/AddProduct' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\ProducteurController','AddProduct']
    ],
    '/Bundle' => [
        'method' => ['GET', 'POST'],
        'controller' => ['Controller\BundleController', 'Bundle']
    ],
    '/Panier' => [
        'method' => ['GET','POST'],
        'controller' => ['Controller\PanierController', 'Panier']
    ],
    '/Contact' => [
        'method' => ['GET', 'POST'],
        'controller' => ['Controller\ContactController', 'Contact']
    ],
    '/Admin' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','Connexion']
    ],

    // '/La/Pire/Route/Du/Monde/Pour/Securiser/L/Inscription/Admin' => [
    //     'method'=>['GET', 'POST'],
    //     'controller'=>['Controller\AdminController','Inscription']
    // ],

    '/Admin/Dashboard' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','Dashboard']
    ],
    '/Admin/AdherentList' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','AdherentList']
    ],
    '/Admin/ModifAdherent/{id:\d+}' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','ModifAdherent']
    ],
    '/Admin/ProducteursList' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','ProducteursList']
    ],
    '/Admin/ModifProducteurs/{id:\d+}' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','ModifProducteurs']
    ],
    '/Admin/ProduitsProducteursList/{id:\d+}' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','ProduitsProducteursList']
    ],
    '/Admin/StatsProducteur' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','StatsProducteurs']
    ],
    '/Admin/ProductsList' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','ProductsList']
    ],
    '/Admin/ModifProducts/{id:\d+}' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','ModifProducts']
    ],
    '/Admin/AddProduct' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','AddProduct']
    ],
];
?>