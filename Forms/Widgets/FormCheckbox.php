<?php
declare(strict_types=1);
namespace Forms\Widgets;
use Forms\Widgets\FormWidget;
class FormCheckbox implements FormWidget
{
    private string $id;
    private string $label;
    private array $values;
    private array $selected;

    public function __construct(string $id, string $label, array $values, array $selected)
    {
        $this->id = $id;
        $this->label = $label;
        $this->values = $values;
        $this->selected = $selected;
    }
    public function render(): string
    {
        $html = "<td>";
        $html .= "<label for='{$this->id}' class='form-label'>{$this->label}:</label>";
        $html .= "</td><td><table>";
        foreach ($this->values as $value) {
            $html .= "<tr><td>";
            $checked = in_array($value, $this->selected) ? "checked" : "";
            $html .= "<input type='checkbox' id='{$this->id}' name='{$this->id}' {$checked}/>";
            $html .= "</td><td>";
            $html .= "<label for='{$this->id}' class='form-label'>{$value}</label>";
            $html .= "</td></tr>";
        }
        $html .= "</table></td>";
        return $html;
    }
}