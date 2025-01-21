<?php
declare(strict_types=1);
namespace Forms\Widgets;
use Forms\Widgets\FormWidget;
class FormDate implements FormWidget
{
    private string $id;
    private string $label;
    private string $selected;

    public function __construct(string $id, string $label, string $selected)
    {
        $this->id = $id;
        $this->label = $label;
        $this->selected = $selected;
    }
    public function render(): string
    {
        $html = "<td>";
        $html .= "<label for='{$this->id}' class='form-label'>{$this->label}:</label>";
        $html .= "</td><td>";
        $date = date_create($this->selected);
        $html .= "<input type='datetime-local' id='{$this->id}' name='{$this->id}' value='" . str_replace(" ", "T", date_format($date, "Y-m-d H:i")) . "'/>";
        $html .= "</td>";
        return $html;
    }
}