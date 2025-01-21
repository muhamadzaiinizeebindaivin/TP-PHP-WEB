<?php
namespace Model\Quiz;
abstract class Question
{
    protected string $name;
    protected string $type;
    protected string $label;
    protected array|null $choices;
    protected string|array $answer;
    protected int $score;
    public function __construct(string $name, string $label, array|null $choices, string|array $answer, int $score)
    {
        $this->name = $name;
        $this->label = $label;
        $this->choices = $choices;
        $this->answer = $answer;
        $this->score = $score;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getType(): string
    {
        return $this->type;
    }
    public function getLabel(): string
    {
        return $this->label;
    }
    public function getChoices(): array|null
    {
        return $this->choices;
    }
    public function getAnswer(): string|array
    {
        return $this->answer;
    }
    public function getScore(): int
    {
        return $this->score;
    }
    public abstract function renderQuestion(): string;
    public abstract function renderAnswer(string|array|null $answer): string;
}