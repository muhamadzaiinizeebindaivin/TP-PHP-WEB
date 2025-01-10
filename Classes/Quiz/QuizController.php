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
}