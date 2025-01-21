<?php
declare(strict_types=1);
namespace Forms\Widgets;
use Forms\Widgets\FormWidget;
class FormSelect implements FormWidget
{
    private string $id;
    private string $label;
    private array $values;
    private string|int|float $value;

    public function __construct(string $id, string $label, array $values, string|int|float $value)
    {
        $this->id = $id;
        $this->label = $label;
        $this->values = $values;
        $this->value = $value;
    }
    public function render(): string
    {
        $html = "<td>";
        $html .= "<label for='{$this->id}' class='form-label'>{$this->label}:</label>";
        $html .= "</td><td>";
        $html .= "<select id='{$this->id}' name='{$this->id}' class='form-input form-input-select'>";
        foreach ($this->values as $value) {
            $selected = $this->value === $value ? "selected" : "";
            $html .= "<option value='{$value}' {$selected}>{$value}</option>";
        }
        $html .= "</select>";
        $html .= "</td>";
        return $html;
    }
}