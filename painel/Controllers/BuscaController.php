<?php

namespace Controllers;

use \Core\Controller;
use \Models\Professor;
use \Models\Cursos;
class BuscaController extends Controller{
    public function index(){
        $dados=array(
            'info'=>array(),
            'cursos'=>array()
        );

        $Professor=new Professor();
		$Professor->setProfessor($_SESSION['admin']);
		
        $dados['info']=$Professor;
        
        if(!empty($_GET['busca'])){
            $busca=$_GET['busca'];
            $dados['busca']=$busca;
          
            $curso=new Cursos();
            $dados['cursos']=$curso->getCursoPesquisado($busca);
        }else{
            header('Location:'.BASE);
        }

        $this->loadTemplate('busca',$dados);
    }
}