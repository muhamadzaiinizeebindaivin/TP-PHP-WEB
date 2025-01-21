<?php
namespace Model\Quiz;
use Model\Quiz\Question;
class Radio extends Question
{
    public function renderQuestion(): string
    {
        $html = "<h3>" . $this->label . "</h3>";
        $html .= "<table>";
        foreach ($this->choices as $i => $choice) {
            $html .= "<tr>";
            $html .= "<td>"."<input type='radio' name='$this->name' value='$choice' id='$this->name-$i'" . ($i == 0 ? "checked='checked'" : "") . ">"."</td>";
            $html .= "<td>"."<label for='$this->name-$i'>$choice</label>"."</td>";
            $html.= "</tr>";
        }
        $html.= "</table>";
        return $html;
    }
    public function renderAnswer(string|array|null $answer): string
    {
        $score = strcasecmp($this->answer, $answer) === 0 ? $this->score : 0;
        $_SESSION['score'] += $score;
        $html = "<h3>" . $this->label . " " . $score . "/" . $this->score . "</h3>";
        $html .= "<table>";
        $html .= "<tr>";
        $html .= "<td>Réponse attendue: </td>";
        $html .= "<td>";
        foreach ($this->choices as $i => $choice) {
            $html .= "<input type='radio' name='$this->name-answer' disabled='disabled' value='$this->name' id='$this->name-$i-answer'" . (strcasecmp($choice, $this->answer) === 0 ? "checked='checked'" : "") . ">";
            $html .= "<label for='$this->name-$i'>$choice</label>";
        }
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td>Réponse fournie: </td>";
        $html .= "<td>";
        foreach ($this->choices as $i => $choice) {
            $html .= "<input type='radio' name='$this->name' disabled='disabled' value='$this->name' id='$this->name-$i'" . (strcasecmp($choice, $answer) === 0 ? "checked='checked'" : "") . ">";
            $html .= "<label for='$this->name-$i'>$choice</label>";
        }
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "</table>";
        return $html;
    }
}