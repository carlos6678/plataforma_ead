<?php
namespace Controllers;
use \Models\Alunos;
use \Core\Controller;
class LoginController extends Controller{
	public function index(){
		$dados=array();
		if(isset($_POST['email']) && !empty($_POST['email'])){
			$email=addslashes($_POST['email']);
			$senha=md5($_POST['senha']);

			$alunos = new Alunos();

			if($alunos->existe($email,$senha)){
				header('Location:'.BASE.'home');
			}
		}


		$this->loadView('login',$dados);
	}
	public function cadastro(){
		$dados=array(); 
		$aluno=new Alunos();
		if(isset($_POST['email']) && !empty($_POST['email'])){
			if(!$aluno->EmailExiste($_POST['email']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
				$nome=addslashes($_POST['nome']);
				$email=addslashes($_POST['email']);
				$senha=md5($_POST['senha']); 

				$aluno->cadastrarAluno($nome,$email,$senha);
				header('Location:'.BASE.'login');
			}
		}
		$this->loadView('cadastro',$dados);
	}
	public function logout(){
		unset($_SESSION['aluno']);
		unset($_SESSION['usuario_hash']);
		header('Location:'.BASE);
	}
}