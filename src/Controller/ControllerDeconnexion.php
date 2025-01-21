<?php 
namespace Controller;
class ControllerDeconnexion extends Controller {
    public function get(): void{
        $this-> render("deconnexion",[]);
    }
}