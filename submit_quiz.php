<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '_inc/autoload.php';

use Classes\Quiz\QuizController;
use Classes\Quiz\ScoreManager;

$_SESSION['idP'] = 1;

$controller = new QuizController();
$score = $controller->checkAnswers($_POST);

$scoreManager = new ScoreManager();
$idP = $_SESSION['idP'];
if ($scoreManager->saveScore($idP, $score)) {
    error_log("Score enregistré avec succès pour l'utilisateur $idP : $score");
} else {
    error_log("Erreur lors de l'enregistrement du score pour l'utilisateur $idP.");
}

error_log("POST data: " . print_r($_POST, true));
error_log("Score: " . $score);
error_log("Session data: " . print_r($_SESSION, true));

header("Location: ./Classes/Templates/results.php");
exit();
