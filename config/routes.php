<?php
// Tableau associatif des routes
$routes = [
    '/' => [
        'controller' => \Controller\ControllerHome::class,
        'methods' => [
            'GET'
        ],
        'redirect' => '/'
    ],
    '/inscription' => [
        'controller' => \Controller\ControllerInscription::class,
        'methods' => [
            'GET', 'POST'
        ],
        'redirect' => '/'
    ],
    '/connexion' => [
        'controller' => \Controller\ControllerLogin::class,
        'methods' => [
            'GET', 'POST'
        ],
        'redirect' => '/'
    ],
    '/result' => [
        'controller' => \Controller\ControllerResult::class,
        'methods' => [
            'POST'
        ],
        'redirect' => '/'
    ],
    '/answer' => [
        'controller' => \Controller\ControllerAnswer::class,
        'methods' => [
            'GET', 'POST'
        ],
        'redirect' => '/'
    ],
    '/questions' => [
        'controller' => \Controller\ControllerQuestions::class,
        'methods' => [
            'GET'
        ],
        'redirect' => '/'
    ],
    
];
