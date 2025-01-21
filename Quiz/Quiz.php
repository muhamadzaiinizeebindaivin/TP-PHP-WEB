<?php
namespace Model\Quiz;
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
        $html .= "<h3>Votre score final est de " . $_SESSION['score'] . "/" . array_sum(array_map(fn($q): int => $q->getScore(), $this->questions)) . "</h3>";
        $html .= "<h3>Merci de votre participation</h3>";
        return $html;
    }
}