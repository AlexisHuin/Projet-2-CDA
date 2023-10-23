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
    '/User/AddPanier'=> [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\PanierController','AddPanier']
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
    '/Admin/AdherentsList' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','AdherentsList']
    ],
    '/Admin/ModifAdherents{id:\d+}' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','ModifAdherents']
    ],
    '/Admin/ProducteursList' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','ProducteursList']
    ],
    '/Admin/ModifProducteurs{id:\d+}' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','ModifProducteurs']
    ],
    '/Admin/StatsProducteur' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','StatsProducteurs']
    ],
    '/Admin/ProductsList' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','ProductsList']
    ],
    '/Admin/ModifProducts{id:\d+}' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','ModifProducts']
    ],
    '/Admin/AddProduct' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\AdminController','AddProduct']
    ],
];
?>