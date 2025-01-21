<?php
declare(strict_types=1);
namespace Forms;

use Forms\Widgets\FormPassword;
use Forms\Widgets\FormText;
class LoginForm implements Form
{

    private string $action;
    private array $widgets;

    public function __construct(string $action)
    {
        $this->action = $action;
        $this->widgets = [
            new FormText("identifiant", "Identifiant", ""),
            new FormPassword("password", "Mot de passe", "")
        ];
    }
    public function render(): string
    {
        $html = "<form method='POST' action='{$this->action}' class='form'>";
        $html .= "<table class='form-table'>";
        foreach ($this->widgets as $widget) {
            $html .= "<tr class='form-row'>";
            $html .= $widget->render();
            $html .= "</tr>";
        }
        $html .= "<tr class='form-row'>";
        $html .= "<td><input type='submit' name='submit' value='" . "Se connecter" . "' class='form-submit'></td>";
        $html .= "</tr>";
        $html .= "</table>";
        $html .= "</form>";
        return $html;
    }
}