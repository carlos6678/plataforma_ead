<?php
namespace Controllers;
use \Models\Alunos;
use \Models\Aulas;
use \Models\Cursos;
use \Models\Modulos;
use \Core\Controller;
class CursosController extends Controller{
	public function __construct(){
		$aluno=new Alunos();
		if(!$aluno->EstiverLogado()){
			header('Location:'.BASE.'login');
		}
	}
	public function index(){
		header('Location:'.BASE);
	}
	public function entrar($id_curso){
		$dados=array(
			'info'=>array(),
			'curso'=>array(),
			'modulos'=>array(),
			'professor'=>array(),
			'cursos_relacionados'=>array(),
			'cursos_professor'=>array(),
			'qtCursosAlunos'=>array(),
			'qtAlunos'=>array(), 
			'comenatarios_curso'=>array()
		);
		$alunos = new Alunos();
		$alunos->setAluno($_SESSION['aluno']);
		$dados['info']=$alunos;

		if($alunos->EstaInscrito($id_curso)){
			$curso=new Cursos();
			$curso->setCurso($id_curso);
			$dados['curso']=$curso;
			$dados['alunos']=$alunos;
			$modulos=new Modulos();
			$dados['modulos']=$modulos->getModulos($id_curso);

			$id_professor=$curso->getIdProfessor($id_curso);

			$dados['professor']=$curso->getProfessor($id_professor);
			$dados['cursos_relacionados']=$curso->getCursosDoProfessor($id_professor);
			$dados['cursos_professor']=$curso->getProfessorIdCursos($id_professor);

			foreach ($dados['cursos_professor'] as $keyCurso =>$num_curso) {
				$dados['qtCursosAlunos'][$keyCurso]=$curso->getQuantidadeDeAlunosProfessor($num_curso['id']);

				foreach ($dados['qtCursosAlunos'][$keyCurso] as $keyAluno => $value) {
					array_push($dados['qtAlunos'], $value['id_aluno']);
				}
			}
			$imagem=$alunos->getFoto();
			$nome=$alunos->getNome();
			if(isset($_POST['comentario']) && !empty($_POST['comentario'])){
				$comentario=addslashes($_POST['comentario']);
				$curso->inserirComentarioNoCurso($_SESSION['aluno'],$id_curso,$nome,$comentario,$imagem);
				header("Location:".BASE.'cursos/entrar/'.$id_curso);
			}
			$curso->UpdateInserirComentarioNoCurso($_SESSION['aluno'],$alunos->getNome(),$alunos->getFoto());
			$dados['comentarios_curso']=$curso->Comentarios($id_curso);
			$this->loadTemplate('cursos_entrar',$dados);
		}else{
			header('Location:'.BASE.'home/cursos_entrar_view/'.$id_curso);
		}
	}
	public function aula($id_aula){
		$dados=array(
			'info'=>array(),
			'curso'=>array(),
			'modulos'=>array(),
			'professor'=>array(),
			'cursos_relacionados'=>array(),
			'cursos_professor'=>array(),
			'qtCursosAlunos'=>array(),
			'qtAlunos'=>array(), 
			'comenatarios_curso'=>array()
		);
		$alunos = new Alunos();
		$alunos->setAluno($_SESSION['aluno']);
		$dados['info']=$alunos;

		$aula=new Aulas();
		$id_curso=$aula->getCursoDaAula($id_aula);

		if($alunos->EstaInscrito($id_curso)){
			$dados['aula_info']=$aula->getAula($id_aula);
			$curso=new Cursos();
			$curso->setCurso($id_curso);
			$dados['curso']=$curso;
			$dados['alunos']=$alunos;
			$modulos=new Modulos();
			$dados['modulos']=$modulos->getModulos($id_curso);

			$id_professor=$curso->getIdProfessor($id_curso);

			$dados['professor']=$curso->getProfessor($id_professor);
			$dados['cursos_relacionados']=$curso->getCursosDoProfessor($id_professor);
			$dados['cursos_professor']=$curso->getProfessorIdCursos($id_professor);

			foreach ($dados['cursos_professor'] as $keyCurso =>$num_curso) {
				$dados['qtCursosAlunos'][$keyCurso]=$curso->getQuantidadeDeAlunosProfessor($num_curso['id']);

				foreach ($dados['qtCursosAlunos'][$keyCurso] as $keyAluno => $value) {
					array_push($dados['qtAlunos'], $value['id_aluno']);
				}
			}
			if($dados['aula_info']['tipo']==='video'){
				$view='curso_aula_video';
			}elseif($dados['aula_info']['tipo']==='poll'){
				$view='curso_aula_poll';
			}
			if(isset($_POST['duvida']) && !empty($_POST['duvida'])){
				$duvida=addslashes($_POST['duvida']);

				$aula->setDuvidas($duvida,$_SESSION['aluno'],$id_aula);
				header('Location:'.BASE.'cursos/aula/'.$id_aula);
			}
			if(isset($_POST['opcao']) && !empty($_POST['opcao'])){
				$opcao=$_POST['opcao'];
				if($opcao==$dados['aula_info']['resposta']){
					$dados['resposta']=true;
				}else{
					$dados['resposta']=false;
				}
			}
			$imagem=$alunos->getFoto();
			$nome=$alunos->getNome();
			if(isset($_POST['comentario']) && !empty($_POST['comentario'])){
				$comentario=addslashes($_POST['comentario']);
				$curso->inserirComentarioNoCurso($_SESSION['aluno'],$id_curso,$nome,$comentario,$imagem);
				header("Location:".BASE.'cursos/entrar/'.$id_curso);
			}
			$curso->UpdateInserirComentarioNoCurso($_SESSION['aluno'],$alunos->getNome(),$alunos->getFoto());
			$dados['comentarios_curso']=$curso->Comentarios($id_curso);
			$dados['duvidas']=$aula->getDuvidas($id_aula);
			$this->loadTemplate($view,$dados);
		}else{
			header('Location:'.BASE); 
		}
	}
}