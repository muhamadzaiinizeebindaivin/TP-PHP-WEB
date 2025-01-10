<?php
abstract class Question
{
    protected $uuid;
    protected $label;
    protected $choices;
    protected $correct;
    protected $userAnswer;

    public function __construct($uuid, $label, $choices, $correct)
    {
        $this->uuid = $uuid;
        $this->label = $label;
        $this->choices = $choices;
        $this->correct = $correct;
    }

    abstract public function render();
    abstract public function checkAnswer($answers);
    abstract public function showResults();
}
