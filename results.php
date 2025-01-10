<?php
session_start();

// Vérifier si les résultats existent
if (!isset($_SESSION['quiz_results'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Résultats du Quiz</title>
    <style>
        .correct { color: green; }
        .incorrect { color: red; }
        .result-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .score {
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <div class="score">
            Score final : <?php echo $_SESSION['total_score']; ?> / <?php echo $_SESSION['max_score']; ?>
        </div>
        
        <h2>Détail des réponses :</h2>
        <?php foreach ($_SESSION['quiz_results'] as $questionName => $result): ?>
            <div class="<?php echo $result['isCorrect'] ? 'correct' : 'incorrect'; ?>">
                <p>
                    Question : <?php echo $questionName; ?><br>
                    Votre réponse : <?php 
                        echo is_array($result['submitted']) 
                            ? implode(', ', $result['submitted']) 
                            : $result['submitted']; 
                    ?><br>
                    <?php if (!$result['isCorrect']): ?>
                        Réponse correcte : <?php 
                            echo is_array($result['correct']) 
                                ? implode(', ', $result['correct']) 
                                : $result['correct']; 
                        ?>
                    <?php endif; ?>
                </p>
            </div>
        <?php endforeach; ?>
        
        <a href="index.php">Recommencer le quiz</a>
    </div>
</body>
</html>