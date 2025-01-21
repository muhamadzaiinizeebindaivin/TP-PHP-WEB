<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log the current directory
error_log("Current directory: " . __DIR__);

require_once '_inc/autoload.php';

// Test if autoload.php was included
error_log("Autoload included");

use Classes\Quiz\QuizController;

// Log that we're attempting to create controller
error_log("Attempting to create QuizController");

$controller = new QuizController();
$result = $controller->handleRequest();

echo $result;


