<?php 
namespace Controller;
class ControllerLogin extends Controller {
    public function get(): void{
        $this-> render("login",[]);
    }

    public function post(): void{
        $this->render("login",[]);
    }
}