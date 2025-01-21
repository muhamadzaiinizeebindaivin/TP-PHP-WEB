<?php
namespace Model\Quiz;
use Model\Quiz\Question;
class Text extends Question
{

    public function renderQuestion(): string
    {
        return "<h3>" . $this->label . "</h3><input type='text' name='$this->name'>";
    }
    public function renderAnswer(string|array|null $answer): string
    {
        $score = strcasecmp($this->answer, $answer) === 0 ? $this->score : 0;
        $_SESSION['score'] += $score;
        $html = "<h3>" . $this->label . " " . $score . "/" . $this->score . "</h3>";
        $html .= "<table>";
        $html .= "<tr>";
        $html .= "<td>Réponse attendue: </td>";
        $html .= "<td>$this->answer</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td>Réponse fournie: </td>";
        $html .= "<td>$answer</td>";
        $html .= "</tr>";
        $html .= "</table>";
        return $html;
        ;
    }
}