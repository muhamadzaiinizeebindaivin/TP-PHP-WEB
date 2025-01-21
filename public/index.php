<?php
// Démarrage de la session
session_start();

// Inclusion de l'autoloader pour charger automatiquement les classes
require_once __DIR__ . '/../src/autoloader.php';

// Chargement des routes
$route = require_once __DIR__ . '/../config/routes.php';

// Récupération de l'URL demandée, ou "/" par défaut
$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
// Vérification de l'existence de la route et appel du contrôleur
if (array_key_exists($url, $routes)) {
    $controllerName = $routes[$url]['controller'];
    $methods = $routes[$url]['methods'];
    $redirectRelPath = isset($routes[$url]['redirect']) ? $routes[$url]['redirect'] : '/';
    $protocol = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';
    $redirect = $protocol . "://" . $_SERVER["HTTP_HOST"] . $redirectRelPath;
    if(!in_array($_SERVER['REQUEST_METHOD'], $methods)){
        http_response_code(405);
        header('Location: ' . $redirect);
        exit();
    }

    $methodName = strtolower($_SERVER['REQUEST_METHOD']);
    
    // Création d'une instance du contrôleur et appel de la méthode
    $controller = new $controllerName();
    $controller->$methodName();
} else {
    // Si la route n'existe pas, afficher une erreur 404
    header("HTTP/1.0 404 Not Found");
    echo "Page not found";
}

// Fermeture de la session
session_write_close();
