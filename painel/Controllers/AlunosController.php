<?php
namespace Controllers;
use \Core\Controller;
use \Models\Alunos;
use \Models\Usuarios;
use \Models\Cursos;
class AlunosController extends Controller{
	public function __construct(){
		$usuarios=new Usuarios();
		if(!$usuarios->EstiverLogado()){
			header('location:'.BASE.'login');
		}
	}
	public function index(){
		$dados=array(
			'alunos'=>array(),
			'info'=>array()
		);
		$Professor=new Professor();
		$Professor->setProfessor($_SESSION['admin']);
		$dados['info']=$Professor;
		$alunos= new Alunos();
		$dados['alunos']=$alunos->getAlunos();
		$this->loadTemplate('alunos',$dados);
	}
	public function deletar($id_aluno){
		$cursos=new Alunos();
		$cursos->deletarAluno($id_aluno);
		header('Location:'.BASE.'alunos');
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
			$email=addslashes($_POST['email']);
			$senha=md5($_POST['senha']);

			$alunos=new Alunos();
			$alunos->adicionarAluno($nome,$email,$senha);
			header('Location:'.BASE.'alunos');
		}

		$this->loadTemplate('adicionar_aluno',$dados);
	}
	public function editar($id_aluno){
		$dados=array(
			'aluno'=>array(),
			'cursos'=>array(),
			'info'=>array()
		);
		$Professor=new Professor();
		$Professor->setProfessor($_SESSION['admin']);
		$dados['info']=$Professor;
		$aluno=new Alunos();
		$cursos=new Cursos();
		$dados['aluno']=$aluno->getAluno($id_aluno);
		if($_SESSION['admin']==ROOT){
			$dados['cursos']=$cursos->getCursos();
		}else{
			$dados['cursos']=$cursos->getCursosProfessor($_SESSION['admin']);
		}
		$dados['inscritos']=$cursos->getCursosInscritos($id_aluno);
		if(isset($_POST['nome']) && !empty($_POST['nome'])){
			$nome=addslashes($_POST['nome']);
			$email=addslashes($_POST['email']);
			$senha=md5($_POST['senha']);
			$cursos=$_POST['cursos'];

			$aluno->updateAluno($id_aluno,$nome,$email,$senha,$cursos);
			header("Location:".BASE."alunos/editar/".$id_aluno);
		}

		$this->loadTemplate('editar_aluno',$dados);
	}
}