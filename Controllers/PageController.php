<?php
namespace Controllers;
use \Models\Cursos;
use \Core\Controller;
class PageController extends Controller{
	public function index(){
		$dados = array(
			'categorias'=>array(), 
			'carousel'=>array(), 
			'curso_paginaçao'=>array()

		);
		$cursos=new Cursos();
		//paginanaçao
		$total_reg=8;
		$pagina=0;
		if(isset($_GET['pagina']) && !empty($_GET['pagina'])){
			$pagina=$_GET['pagina'];
		}
		$inicio=$pagina*$total_reg; 
		$dados['total_regs']=$cursos->contarRegistrosCursos()/$total_reg;
		$dados['curso_paginaçao']=$cursos->paginaçao($inicio,$total_reg);
		//fim  da paginaçao
		$cursos_destaque=$cursos->getCursosDestaque();
		$dados['categorias']=$cursos->getCategorias();
		foreach($dados['categorias'] as $key=>$value){
			foreach($cursos_destaque as $value1){
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