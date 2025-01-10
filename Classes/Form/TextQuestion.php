<?php
class TextQuestion extends Question
{
    public function render()
    {
        echo "<label>{$this->text}</label><input type='text' name='{$this->name}' required><br>";
    }

    public function checkAnswer($answers)
    {
        $this->userAnswer = isset($answers[$this->name]) ? $answers[$this->name] : null;
    }

    public function showResults()
    {
        echo "{$this->text}<br>";
        echo "Réponse correcte: " . ($this->userAnswer === $this->answer ? "Oui" : "Non") . "<br>";
    }
}
