<?php
class CheckboxQuestion extends Question
{
    private $choices;

    public function __construct($name, $text, $choices, $answer, $score)
    {
        parent::__construct($name, $text, $answer, $score);
        $this->choices = $choices;
    }

    public function render()
    {
        echo "{$this->text}<br>";
        foreach ($this->choices as $index => $choice) {
            echo "<input type='checkbox' name='{$this->name}[]' value='{$choice['value']}'> {$choice['text']}<br>";
        }
    }

    public function checkAnswer($answers)
    {
        $this->userAnswer = isset($answers[$this->name]) ? $answers[$this->name] : [];
    }

    public function showResults()
    {
        echo "{$this->text}<br>";
        $correct = ($this->userAnswer == $this->answer) ? "Oui" : "Non";
        echo "Réponse correcte: $correct<br>";
    }
}
