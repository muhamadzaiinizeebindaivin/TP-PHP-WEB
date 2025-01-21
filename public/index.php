<?php
session_start();

require_once __DIR__ . '/../src/autoloader.php';

$route = require_once __DIR__ . '/../config/routes.php';

$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
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
    
    $controller = new $controllerName();
    $controller->$methodName();
} else {
    header("HTTP/1.0 404 Not Found");
    echo "Page not found";
}

session_write_close();
