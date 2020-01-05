<?php
namespace Core;
class Controller{
	public function loadView($name,$dados=array()){
		require 'views/'.$name.'.php';
	}
	public function loadTemplate($name,$dados=array()){
		require 'views/template.php';
	}
	public function loadPrincipalTemplate($name,$dados=array()){
		require 'views/template_principal.php';
	}
	public function loadInTemplate($name,$dados=array()){
		extract($dados);
		require 'views/'.$name.'.php';
	}
}