<!-- templates/results.php -->
<?php
session_start();

// Vérifier si les résultats existent
if (!isset($_SESSION['quiz_results'])) {
    header("Location: index.php");
    exit();
}
?>

<?php include('header.php'); ?>

<div class="result-container">
    <div class="score">
        <strong>Score final :</strong> <?php echo $_SESSION['total_score']; ?> / <?php echo $_SESSION['max_score']; ?>
    </div>
    
    <h2>Détail des réponses :</h2>
    <?php foreach ($_SESSION['quiz_results'] as $questionName => $result): ?>
        <div class="<?php echo $result['isCorrect'] ? 'correct' : 'incorrect'; ?>">
            <p>
                <strong>Question :</strong> <?php echo $questionName; ?><br>
                <strong>Votre réponse :</strong> <?php 
                    echo is_array($result['submitted']) 
                        ? implode(', ', $result['submitted']) 
                        : $result['submitted']; 
                ?><br>
                <?php if (!$result['isCorrect']): ?>
                    <strong>Réponse correcte :</strong> <?php 
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

<?php include('footer.php'); ?>
