<?php 
namespace Controller;
class ControllerHome extends Controller {
    public function get(): void{
        $this-> render("home",[]);
    }
}