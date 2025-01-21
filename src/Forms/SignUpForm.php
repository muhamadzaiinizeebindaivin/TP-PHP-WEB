<?php
declare(strict_types=1);
namespace Forms;

use Forms\Widgets\FormPassword;
use Forms\Widgets\FormText;
class SignUpForm implements Form
{

    private string $action;
    private array $widgets;

    public function __construct(string $action)
    {
        $this->action = $action;
        $this->widgets = [
            new FormText("identifiant", "Identifiant", "", true),
            new FormText("prenom", "Prénom", "", true),
            new FormText("nom", "Nom", "", true),
            new FormPassword("password", "Mot de passe", "", false, true),
            new FormPassword("confirm_password", "Confirmation mot de passe", "", true, true)
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
        $html .= "<td><input type='submit' name='submit' value=\"" . "S'inscrire" . "\" class='form-submit'></td>";
        $html .= "</tr>";
        $html .= "</table>";
        $html .= "</form>";
        return $html;
    }

    public function script(): string
    {
        $js = "function check() {
                if (document.getElementById('password').value ==
                    document.getElementById('confirm_password').value) {
                    document.getElementById('confirm_password_message').style.color = 'green';
                    document.getElementById('confirm_password_message').innerHTML = 'Ok';
                } else {
                    document.getElementById('confirm_password_message').style.color = 'red';
                    document.getElementById('confirm_password_message').innerHTML = 'Les mots de passes doivent correspondre';
                }
            }";
        return $js;
    }
}