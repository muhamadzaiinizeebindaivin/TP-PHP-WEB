<?php 
namespace Controller;
class ControllerAnswer extends Controller {
    public function get(): void{
        $this-> render("answer",[]);
    }

    public function post(): void{
        $this->render("answer",[]);
    }
}