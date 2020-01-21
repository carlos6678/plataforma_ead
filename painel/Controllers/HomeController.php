<?php
namespace Controllers;
use \Core\Controller;
use \Models\Usuarios;
use \Models\Cursos;
use \Models\Modulos;
use \Models\Professor;
class HomeController extends Controller{
	public function __construct(){
		$usuarios=new Usuarios();
		if(!$usuarios->EstiverLogado()){
			header('location:'.BASE.'login');
		}
	}
	public function index(){
		$dados=array(
			'cursos'=>array(),
			'info'=>array()
		);
		$cursos=new Cursos();
		if($_SESSION['admin']==ROOT){
			$dados['cursos']=$cursos->getCursos();
		}else{
			$dados['cursos']=$cursos->getCursosProfessor($_SESSION['admin']);
		}
		$Professor=new Professor();
		$Professor->setProfessor($_SESSION['admin']);
		
		$dados['info']=$Professor;
		$this->loadTemplate('home',$dados);
	}
	public function adicionar(){
		$dados=array(
			'info'=>array()
		);
		$Professor=new Professor();
		$Professor->setProfessor($_SESSION['admin']);
		$dados['info']=$Professor;
		if(isset($_POST['nome'])&& !empty($_POST['nome'])){
			$nome=addslashes($_POST['nome']);
			$descricao=addslashes($_POST['descricao']);
			$imagem=$_FILES['imagem'];
			$categoria=intval($_POST['categoria']);
			if(!empty($imagem['tmp_name'])){
				$criptyName=md5(time().rand(0,99)).'.jpg';
				$type=array('image/jpg','image/jpeg','image/png');
				if(in_array($imagem['type'],$type)){
					move_uploaded_file($imagem['tmp_name'],"../assets/imagens/cursos/".$criptyName);
					$cursos=new Cursos();
					$cursos->adicionarCurso($nome,$criptyName,$descricao,$_SESSION['admin'],$categoria,$valor);
					header('location:'.BASE);
				}
			}
		}

		$this->loadTemplate('cadastrar_curso',$dados);
	}
	public function editar($id_curso){
		$dados=array(
			'curso'=>array(),
			'modulos'=>array(),
			'info'=>array(),
			'id_curso'=>$id_curso
		);
		$Professor=new Professor();
		$Professor->setProfessor($_SESSION['admin']);
		$dados['info']=$Professor;
		
		$cursos=new Cursos();
		$dados['curso']=$cursos->getCurso($id_curso);

		$modulos=new Modulos();
		$dados['modulos']=$modulos->getModulos($id_curso);
		$this->loadTemplate('editar_curso',$dados);
	}
	public function editarContaProfessor($id_professor){
		$dados=array(
			'info'=>array()
		);
		$Professor=new Professor();
		$Professor->setProfessor($id_professor);
		if(isset($_POST['nome']) && !empty($_POST['nome'])){
			$nome=addslashes($_POST['nome']);
			$email=addslashes($_POST['email']);
			$senha=md5($_POST['senha']);

			$Professor->updateProfessor($id_professor,$nome,$email,$senha);
			$Professor->setProfessor($id_professor);
			header('Location:'.BASE.'home/editarContaProfessor/'.$id_professor);
		} 
		if(isset($_FILES['foto_perfil']['tmp_name']) && !empty($_FILES['foto_perfil']['tmp_name'])){
			$cryptName=md5(time().rand(0,99)).'.jpg';
			$types=array('image/jpeg','image/jpg','image/png');
			if(in_array($_FILES['foto_perfil']['type'],$types)){
				move_uploaded_file($_FILES['foto_perfil']['tmp_name'],'assets/imagens/professores/'.$cryptName);
				$Professor->perfilProfessor($id_professor,$cryptName);
				$Professor->setProfessor($id_professor);
				header('Location:'.BASE.'home/editarContaProfessor/'.$id_professor);
			}
		}
		$dados['info']=$Professor;
		$this->loadTemplate('ContaProfessor',$dados); 
	}
}