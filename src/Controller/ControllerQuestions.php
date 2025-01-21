<?php 
namespace Controller;
class ControllerQuestions extends Controller {
    public function get(): void{
        $this-> render("questions",[]);
    }
}