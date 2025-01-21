<?php
declare(strict_types=1);
namespace Model\Quiz;
use Model\Quiz\Question;
class Checkbox extends Question
{
    public function renderQuestion(): string
    {
        $html = "<h3>" . $this->label . "</h3>";
        $html .= "<table>";
        foreach ($this->choices as $i => $c) {
            $html .= "<tr>";
            $html .= "<td>"."<input type='checkbox' name='$this->name[]' value='$c' id='$this->name-$i'>"."</td>";
            $html .= "<td>"."<label for='$this->name-$i'>$c</label>"."</td>";
            $html.= "</tr>";
        }
        $html.= "</table>";
        return $html;
    }
    public function renderAnswer(string|array|null $answers): string
    {
        if ($answers === null) {
            $erreurs = $this->score;
        } else {
            $erreurs = (count(array_diff($answers, $this->answer)) + count(array_diff($this->answer, $answers))) * 0.5;
        }
        $score = $erreurs > $this->score ? 0 : $this->score - $erreurs;
        $_SESSION['score'] += $score;
        $html = "<h3>" . $this->label . " " . $score . "/" . $this->score . "</h3>";
        $html .= "<table>";
        $html .= "<tr>";
        $html .= "<td>Réponse attendue: </td>";
        $html .= "<td>";
        foreach ($this->choices as $i => $c) {
            $html .= "<input type='checkbox' name='$this->name[]' disabled='disabled' value='$this->name-$i' id='$this->name-$i-answer' " . (in_array($c, $this->answer) ? "checked='checked'" : "") . ">";
            $html .= "<label for='$this->name-$i'>$c</label>";
        }
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td>Réponse fournie: </td>";
        $html .= "<td>";
        foreach ($this->choices as $i => $c) {
            $html .= "<input type='checkbox' name='$this->name[]' disabled='disabled' value='$this->name-$i' id='$this->name-$i'" . ($answers === null ? "" : (in_array($c, $answers) ? "checked='checked'" : "")) . ">";
            $html .= "<label for='$this->name-$i'>$c</label>";
        }
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "</table>";
        return $html;
    }
}