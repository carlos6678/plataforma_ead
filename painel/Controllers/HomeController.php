<?php
namespace Controllers;
use \Core\Controller;
use \Models\Usuarios;
use \Models\Cursos;
use \Models\Modulos;
use \Models\Aulas;
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
			if(!empty($_POST['gratis'])){
				$valor=addslashes(floatval($_POST['gratis']));
			}else{
				$valor=addslashes(floatval($_POST['valor']));
			}
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
			'info'=>array()
		);
		$Professor=new Professor();
		$Professor->setProfessor($_SESSION['admin']);
		$dados['info']=$Professor;
		if(isset($_POST['nome'])&&!empty($_POST['nome'])){
			$nome=addslashes($_POST['nome']);
			$descricao=addslashes($_POST['descricao']);
			$imagem=$_FILES['imagem'];
			
			$cursos=new Cursos();
			$cursos->editarCurso($nome,$descricao,$id_curso);
			if(!empty($imagem['tmp_name'])){
				$criptyName=md5(time().rand(0,99)).'.jpg';
				$type =array('image/jpg','image/jpeg','image/png'); 

				if(in_array($imagem['type'],$type)){
					move_uploaded_file($imagem['tmp_name'],"../assets/imagens/cursos/".$criptyName);

					$cursos=new Cursos();
					$cursos->editarCursoImagem($criptyName,$id_curso);
				}
			}
		}
		//Usuario adicionou novo modulo
		if(isset($_POST['Modulo']) && !empty($_POST['Modulo'])){
			$modulo=utf8_decode(addslashes($_POST['Modulo']));
			$modulos=new Modulos();
			$modulos->adicionarModulo($modulo,$id_curso);
		} 
		//Usuario adicionou uma aula
		if(isset($_POST['Aula']) && !empty($_POST['Aula'])){
			$aula=addslashes($_POST['Aula']);
			$ModuloAula=$_POST['ModuloAula'];
			$tipo=$_POST['tipo'];

			$aulas= new Aulas();
			$aulas->adicionarAula($id_curso,$ModuloAula,$tipo,$aula);
		}
		$cursos=new Cursos();
		$dados['curso']=$cursos->getCurso($id_curso);

		$modulos=new Modulos();
		$dados['modulos']=$modulos->getModulos($id_curso);
		$this->loadTemplate('editar_curso',$dados);
	}
	public function deletarModulo($id_modulo){
		$modulo=new Modulos();
		$id_curso=$modulo->deletarModulo($id_modulo);
		header('Location:'.BASE.'home/editar/'.$id_curso);
	}
	public function editarModulo($id_modulo){
		$dados=array(
			'modulo'=>array(),
			'info'=>array()
		);
		$modulo=new Modulos();
		$Professor=new Professor();
		$Professor->setProfessor($_SESSION['admin']);
		$dados['info']=$Professor;
		if(isset($_POST['nome']) && !empty($_POST['nome'])){
			$nome=utf8_decode(addslashes($_POST['nome']));
			$id_curso=$modulo->updateModulo($nome,$id_modulo);
			header('Location:'.BASE.'home/editar/'.$id_curso);
			exit;
		}

		$dados['modulo']=$modulo->getModulo($id_modulo);

		$this->loadTemplate('editar_modulo_curso',$dados);
	}
	public function deletarAula($id_aula){
		$aula=new Aulas();
		$id_curso=$aula->deletarAula($id_aula);
		header('Location:'.BASE.'home/editar/'.$id_curso);
	}
	public function editarAula($id_aula){
		$dados=array(
			'aula'=>array(),
			'info'=>array()
		);
		$Professor=new Professor();
		$Professor->setProfessor($_SESSION['admin']);
		$dados['info']=$Professor;
		$view="editarAulaVideo";
		if(isset($_POST['nome'])&&!empty($_POST['nome'])){
			$nome=addslashes($_POST['nome']);
			$descricao=addslashes($_POST['descricao_aula']);
			$url=$_POST['url'];

			$aula=new Aulas();
			$id_curso=$aula->updateVideo($id_aula,$nome,$descricao,$url);
			header('Location:'.BASE.'home/editar/'.$id_curso);
		}
		if(isset($_POST['pergunta'])&&!empty($_POST['pergunta'])){
			$pergunta=addslashes($_POST['pergunta']);
			$opcao1=addslashes($_POST['opcao1']);
			$opcao2=addslashes($_POST['opcao2']);
			$opcao3=addslashes($_POST['opcao3']);
			$opcao4=addslashes($_POST['opcao4']);
			$resposta=addslashes($_POST['resposta']);
			
			$aula=new Aulas();
			$id_curso=$aula->updateQuestionario($id_aula,$pergunta,$opcao1,$opcao2,$opcao3,$opcao4,$resposta);
			header('Location:'.BASE.'home/editar/'.$id_curso);
		}

		$aula=new Aulas();
		$dados['aula']=$aula->getAula($id_aula);

		if($dados['aula']['tipo']=='video'){
			$view='editarAulaVideo';
		}else{
			$view='editarAulaQuestionario';
		}
		$this->loadTemplate($view,$dados);
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