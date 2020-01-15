<?php
namespace Controllers;
use \Core\Controller;
use \Models\Usuarios;
use \Models\Professor; 
class LoginController extends Controller{
	public function index(){
		$dados=array(
			'info'=>array()
		);
		$Professor=new Professor();
		if(isset($_SESSION['admin'])){
			$Professor->setProfessor($_SESSION['admin']);
		}
		$dados['info']=$Professor;
		if(isset($_POST['email']) && !empty($_POST['email'])){
			$email=addslashes($_POST['email']);
			$senha=md5($_POST['senha']);

			$usuarios = new Usuarios();

			if($usuarios->existe($email,$senha)){
				header('Location:'.BASE);
			}
		}


		$this->loadView('login',$dados);
	}
	public function logout(){
		unset($_SESSION['admin']);
		header('Location:'.BASE_PRINCIPAL);
	}
	public function inscrever_como_professor(){
		$dados=array(
			'error'=>true,
		);
		if(isset($_POST['email']) && !empty($_POST['email'])){
			$email=addslashes($_POST['email']);
			$senha=md5($_POST['nome']);
			$nome=addslashes($_POST['nome']);

			$professor=new Professor();
			if(!$professor->EmailExiste($email)){
				$professor->cadastrarProfessor($email,$senha,$nome);
				header('Location:'.BASE.'home');
			}else{
				$dados['error']=false;
			}
			
		}

		$this->loadView('cadastrar_professor',$dados);
	}
}