<?php
session_start();

if (!isset($_SESSION['quiz_results'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Résultats du Quiz</title>
    <link rel="stylesheet" href="../../_inc/static/style.css">
</head>
<body>

    <?php include('header.php'); ?>
    <div class="result-container">
        <div class="score">
            <h2>Votre score final</h2>
            <p><?php echo $_SESSION['total_score']; ?> / <?php echo $_SESSION['max_score']; ?> points</p>
        </div>
        
        <h2>Détail de vos réponses :</h2>
        <?php foreach ($_SESSION['quiz_results'] as $questionName => $result): ?>
            <div class="question-result <?php echo $result['isCorrect'] ? 'correct' : 'incorrect'; ?>">
                <h3><?php echo $result['text']; ?></h3>
                <p>
                    <strong>Votre réponse :</strong> 
                    <?php 
                        echo is_array($result['submitted']) 
                            ? implode(', ', $result['submitted']) 
                            : ($result['submitted'] ?? 'Aucune réponse'); 
                    ?>
                </p>
                <?php if (!$result['isCorrect']): ?>
                    <p>
                        <strong>Réponse correcte :</strong> 
                        <?php 
                            echo is_array($result['correct']) 
                                ? implode(', ', $result['correct']) 
                                : $result['correct']; 
                        ?>
                    </p>
                <?php endif; ?>
                <p>Points : <?php echo $result['isCorrect'] ? $result['score'] : '0'; ?>/<?php echo $result['score']; ?></p>
            </div>
        <?php endforeach; ?>
        
        <a href="../../index.php" class="restart-button">Recommencer le quiz</a>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>