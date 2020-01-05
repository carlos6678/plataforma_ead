<?php
namespace Controllers;
use \Models\Cursos;
use \Core\Controller;
class PageController extends Controller{
	public function index(){
		$dados = array(
			'cursos'=>array(),
			'categorias'=>array(), 
			'carousel'=>array()

		);
		$cursos=new Cursos();
		$dados['cursos']=$cursos->getCursos();
		$dados['categorias']=$cursos->getCategorias();
		foreach($dados['categorias'] as $key=>$value){
			foreach($dados['cursos'] as $value1){
				if($value1['id_categoria']==$value['id']){
					$dados['carousel'][$key][]=$value1;
				}
			}
		}
		if(isset($_SESSION['aluno']) && !empty($_SESSION['aluno'])){
			header('Location:'.BASE.'home');
		}else{
			$this->loadPrincipalTemplate('pagina_principal',$dados);
		} 
	}
}