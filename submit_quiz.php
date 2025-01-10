<?php
session_start();

// Stocker les réponses en session
$_SESSION['quiz_answers'] = $_POST;

// Calculer un score (si nécessaire) ou afficher les réponses
header('Location: results.php');
exit;
