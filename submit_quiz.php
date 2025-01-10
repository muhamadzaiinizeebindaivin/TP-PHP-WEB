<?php
session_start();
require_once '_inc/autoload.php';

use Classes\Quiz\QuizController;

$controller = new QuizController();
$score = $controller->checkAnswers($_POST);

// Redirection vers la page des résultats avec le score
header("Location: Classes/Templates/results.php");
exit();