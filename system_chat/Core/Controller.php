<?php
namespace Core;

class Controller{
    public function loadView($name,$dados=array()){
        require 'views/'.$name.'.php';
    }
    public function loadTemplate($name,$dados=array()){
        require 'views/template.php';
    }
    public function loadViewInTemplate($name,$dados=array()){
        extract($dados);
        require 'views/'.$name.'.php';
    }
}