<?php
use Model\Quiz\Quiz;
use Model\DataSources\JsonProvider;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$jsonProvider = new JsonProvider();
$questions = $jsonProvider->getListeQuestions();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style2.css">
    <title>Page d'Accueil</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="quiz-container">
        <h1>Questions</h1>
            <?php
            $quiz = new Quiz('Questions', $questions);
            echo $quiz -> renderQuestion();
            ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
