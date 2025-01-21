<?php
// Include the necessary classes
use Model\Quiz\Quiz;
use Model\DataSources\JsonProvider;

// Load the questions from the provider
$jsonProvider = new JsonProvider();
$questions = $jsonProvider->getListeQuestions();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page des Questions</title>
    <link rel="stylesheet" href="assets/css/answer.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Votre résultat </h1>
    <div>
    <?php
    // Render the quiz form (render the answers)
    $quiz = new Quiz('Answer', $questions);
    echo $quiz->renderAnswer($_POST);
    ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
