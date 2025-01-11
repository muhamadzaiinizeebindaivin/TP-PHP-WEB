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
            $this->questions = json_decode($jsonData, true);
        } else {
            error_log("Questions JSON file not found: " . $filePath);
            $this->questions = [];
        }
    }

    public function handleRequest() {
        ob_start();
        include __DIR__ . '/../Templates/quiz_form.php';
        return ob_get_clean();
    }

    public function checkAnswers($submittedAnswers) {
        $totalScore = 0;
        $results = [];
        $maxScore = 0;

        foreach ($this->questions['questions'] as $question) {
            $questionName = $question['name'];
            $submittedAnswer = isset($submittedAnswers[$questionName]) ? $submittedAnswers[$questionName] : null;
            $isCorrect = false;
            $maxScore += $question['score'];

            switch ($question['type']) {
                case 'text':
                    $isCorrect = strcasecmp(trim($submittedAnswer), trim($question['answer'])) === 0;
                    break;

                case 'radio':
                    $isCorrect = $submittedAnswer === $question['answer'];
                    break;

                case 'checkbox':
                    if (!is_array($submittedAnswer)) {
                        $submittedAnswer = [];
                    }
                    sort($submittedAnswer);
                    $correctAnswer = $question['answer'];
                    sort($correctAnswer);
                    $isCorrect = $submittedAnswer == $correctAnswer;
                    break;
            }

            if ($isCorrect) {
                $totalScore += $question['score'];
            }

            $results[$questionName] = [
                'isCorrect' => $isCorrect,
                'submitted' => $submittedAnswer,
                'correct' => $question['answer'],
                'text' => $question['text'],
                'score' => $question['score']
            ];
        }

        $_SESSION['quiz_results'] = $results;
        $_SESSION['total_score'] = $totalScore;
        $_SESSION['max_score'] = $maxScore;

        return $totalScore;
    }
}