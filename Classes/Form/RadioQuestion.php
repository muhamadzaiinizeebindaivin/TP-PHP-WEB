<?php
class RadioQuestion extends Question
{
    public function render()
    {
        echo "<label>{$this->label}</label><br>";
        foreach ($this->choices as $index => $choice) {
            echo "<input type='radio' name='{$this->uuid}' value='{$choice}' required> {$choice}<br>";
        }
    }

    public function checkAnswer($answers)
    {
        $this->userAnswer = isset($answers[$this->uuid]) ? $answers[$this->uuid] : null;
    }

    public function showResults()
    {
        echo "{$this->label}<br>";
        echo "Réponse correcte: " . ($this->userAnswer === $this->correct ? "Oui" : "Non") . "<br>";
    }
}
