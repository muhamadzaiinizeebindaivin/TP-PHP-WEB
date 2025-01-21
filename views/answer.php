<?php
// Include the necessary classes
use Model\Quiz\Quiz;
use Model\DataSources\JsonProvider;

// Load the questions from the provider
$jsonProvider = new JsonProvider();
$questions = $jsonProvider->getListeQuestions();
define('DB_PATH', __DIR__ . '/../data/database.sqlite');

try {
    // Connectez-vous à votre base de données SQLite
    $pdo = new \PDO('sqlite:' . DB_PATH);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour créer la table
    $sql = "
        CREATE TABLE IF NOT EXISTS scores (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            idutilisateur INTEGER NOT NULL,
            nom TEXT NOT NULL,
            prenom TEXT NOT NULL,
            score INTEGER NOT NULL
        );
    ";

    // Exécutez la requête
    $pdo->exec($sql);
    echo "Table 'scores' créée avec succès.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
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
