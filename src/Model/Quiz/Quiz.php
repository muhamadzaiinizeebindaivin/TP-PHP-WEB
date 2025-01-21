<?php
namespace Model\Quiz;
define('DB_PATH', __DIR__ . '/../data/database.sqlite');

class Quiz
{
    private string $title;
    private array $questions;
    public function __construct(string $title, array $questions)
    {
        $this->title = $title;
        $this->questions = $questions;
    }

    public function renderQuestion(): string
    {
        $html = "<form method='POST' action='/answer'><ol>";
        foreach ($this->questions as $q) {
            $html .= "<li>";
            $html .= $q->renderQuestion();
            $html .= "</li>";
        }
        $html .= "</ol>";
        $html .= "<input type='submit' value='Répondre' name='submit'>";
        $html .=  "</form>";

        return $html;
    }
    public function renderAnswer(array $answers): string
    {
        $_SESSION['score'] = 0;
        $html = "<ol>";
        foreach ($this->questions as $i => $q) {
            $html .= "<li>";
            $html .= $q->renderAnswer($answers[$q->getName()]);
            $html .= "</li>";
        }
        $html .= "</ol>";
    
        $finalScore = $_SESSION['score'];
        $_SESSION['score'] = $finalScore; // Update session score
    
        $html .= "<h3 id='score'>Votre score final est de " . $finalScore . "/" . array_sum(array_map(fn($q): int => $q->getScore(), $this->questions)) . "</h3>";
        $html .= "<h3 id='appre'>Merci de votre participation !</h3>";
    
        $this->saveScoreToDatabase($finalScore); // Save score to database
    
        return $html;
    }
    

private function saveScoreToDatabase(int $score): void
{
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user']['id'];
        $nom = $_SESSION['user']['nom'];
        $prenom = $_SESSION['user']['prenom'];

        try {
            $pdo = new \PDO(dsn: 'sqlite:' . DB_PATH);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("
                INSERT INTO scores (idutilisateur, nom, prenom, score)
                VALUES (:idutilisateur, :nom, :prenom, :score)
            ");

            $stmt->execute([
                ':idutilisateur' => $userId,
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':score' => $score,
            ]);
        } catch (\PDOException $e) {
            // Gérer les erreurs de base de données
            error_log("Erreur d'enregistrement du score: " . $e->getMessage());
        }
    }
}

}