<?php 
namespace Controller;
class ControllerResult extends Controller {
    public function get(): void{
        $this-> render("result",[]);
    }
}