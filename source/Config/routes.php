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
        'controller'=>['Controller\HomeController','Connexion']
    ],
    '/User' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','Connexion']
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
    '/User/ModifProduct' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','ModifProduct']
    ],
    '/Admin' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','Dashboard']
    ],
    '/Admin/AdherentsList' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','AdherentsList']
    ],
    '/Admin/ModifAdherents{id:\d+}' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','ModifAdherents']
    ],
    '/Admin/ProducteursList' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','ProducteursList']
    ],
    '/Admin/ModifProducteurs{id:\d+}' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','ModifProducteurs']
    ],
    '/Admin/ProductsList' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','ProductsList']
    ],
    '/Admin/ModifProducts{id:\d+}' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','ModifProducts']
    ],
    '/Admin/AddProduct' => [
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\UserController','AddProduct']
    ],
];
?>