<?php
$routes = [
    '/' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\HomeController','Index']
    ],
    '/DescriptifProduit' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\HomeController','DescriptifProduit']
    ],
    '/User' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','Connexion']
    ],
    '/User' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','Deconnexion']
    ],
    '/User/Profile' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','Profile']
    ],
    '/User/ProductList' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','ProductList']
    ],
    '/User/ModifProduct{id:\d+}' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','ModifProduct']
    ],
    '/User/AddProduct' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','AddProduct']
    ],
    '/Admin' => [
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