<?php 
namespace Controller;
class ControllerInscription extends Controller {
    public function get(): void{
        $this-> render("inscription",[]);
    }

    public function post(): void{
        $this->render("inscription",[]);
    }
}