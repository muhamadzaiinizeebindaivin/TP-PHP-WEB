<?php
// Include the necessary classes
use Model\Quiz\Quiz;
use Model\DataSources\JsonProvider;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Load the questions from the provider
$jsonProvider = new JsonProvider();
$questions = $jsonProvider->getListeQuestions();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Questions</h1>
        <?php
        $quiz = new Quiz('Questions', $questions);
        echo $quiz -> renderQuestion();
        ?>
    <?php include 'footer.php'; ?>

</body>
</html>
