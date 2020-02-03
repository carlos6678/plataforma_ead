<?php
namespace Core;
abstract class Controller{
	protected function loadView($name,$dados=array()){
		require 'views/'.$name.'.php';
	}
	protected function loadTemplate($name,$dados=array()){
		require 'views/template.php';
	}
	protected function loadPrincipalTemplate($name,$dados=array()){
		require 'views/template_principal.php';
	}
	protected function loadInTemplate($name,$dados=array()){
		extract($dados);
		require 'views/'.$name.'.php';
	}
}