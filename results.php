<?php
session_start();

if (!isset($_SESSION['quiz_answers'])) {
    echo "Aucune réponse soumise.";
    exit;
}

echo "<h1>Vos réponses</h1>";
foreach ($_SESSION['quiz_answers'] as $question => $answer) {
    echo "<p><strong>$question:</strong> ";
    if (is_array($answer)) {
        echo implode(", ", $answer);
    } else {
        echo $answer;
    }
    echo "</p>";
}
