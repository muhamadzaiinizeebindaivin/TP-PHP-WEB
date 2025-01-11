<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '_inc/autoload.php';

use Classes\Quiz\QuizController;

$controller = new QuizController();
$score = $controller->checkAnswers($_POST);

// Debug
error_log("POST data: " . print_r($_POST, true));
error_log("Score: " . $score);
error_log("Session data: " . print_r($_SESSION, true));

header("Location: ./Classes/Templates/results.php");
exit();