<?php
declare(strict_types=1);
namespace Forms\Widgets;
use Forms\Widgets\FormWidget;
class FormPassword implements FormWidget
{
    private string $id;
    private string $label;
    private string|int|float $value;
    private bool $confirm;
    private bool $required;

    public function __construct(string $id, string $label, string|int|float $value, bool $confirm = false, bool $required = false)
    {
        $this->id = $id;
        $this->label = $label;
        $this->value = $value;
        $this->confirm = $confirm;
        $this->required = $required;
    }
    public function render(): string
    {
        $html = "<td>";
        $html .= "<label for='{$this->id}' class='form-label'>{$this->label}:</label>";
        $html .= "</td><td>";
        $html .= "<input type='password' " . ($this->required ? "required" : "") . " onkeyup='check();' id='{$this->id}' name='{$this->id}' value='{$this->value}' class='form-input form-input-text'>";
        $html .= "</td>";
        if ($this->confirm) {
            $html .= "<td><p id='confirm_password_message'></p></td>";
        }
        return $html;
    }
}