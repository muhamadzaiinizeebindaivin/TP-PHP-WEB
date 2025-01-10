<?php
namespace Classes\Quiz;

class QuizController {
    public $questions;

    public function __construct() {
        error_log("QuizController constructor called");
        $this->loadQuestions();
    }

    private function loadQuestions() {
        $filePath = __DIR__ . '/../../Datas/questions.json';

        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $this->questions = json_decode($jsonData, true); // Décodage JSON en tableau PHP
        } else {
            error_log("Questions JSON file not found: " . $filePath);
            $this->questions = [];
        }
    }

    public function handleRequest() {
        // Appeler la vue pour afficher le formulaire
        ob_start();
        include __DIR__ . '/../Templates/quiz_form.php';
        return ob_get_clean();
    }

    public function checkAnswers($submittedAnswers) {
        $totalScore = 0;
        $results = [];
        
        foreach ($this->questions['questions'] as $question) {
            $questionName = $question['name'];
            $submittedAnswer = isset($submittedAnswers[$questionName]) ? $submittedAnswers[$questionName] : null;
            $isCorrect = false;
            
            switch ($question['type']) {
                case 'text':
                    $isCorrect = strcasecmp($submittedAnswer, $question['answer']) === 0;
                    break;
                    
                case 'radio':
                    $isCorrect = $submittedAnswer === $question['answer'];
                    break;
                    
                case 'checkbox':
                    // Conversion en array si nécessaire
                    $submittedArray = is_array($submittedAnswer) ? $submittedAnswer : [$submittedAnswer];
                    sort($submittedArray);
                    
                    $correctArray = $question['answer'];
                    sort($correctArray);
                    
                    $isCorrect = $submittedArray == $correctArray;
                    break;
            }
            
            if ($isCorrect) {
                $totalScore += $question['score'];
            }
            
            $results[$questionName] = [
                'isCorrect' => $isCorrect,
                'submitted' => $submittedAnswer,
                'correct' => $question['answer']
            ];
        }
        
        // Stockage des résultats, dans la session
        $_SESSION['quiz_results'] = $results;
        $_SESSION['total_score'] = $totalScore;
        $_SESSION['max_score'] = array_sum(array_column($this->questions['questions'], 'score'));
        
        return $totalScore;
    }
}