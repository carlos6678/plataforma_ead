<?php
namespace Controllers;
use \Models\Alunos;
use \Models\Cursos;
use \Core\Controller;
use \Models\Modulos;
class HomeController extends Controller{
	public function __construct(){
		$alunos=new Alunos();
		if(!$alunos->EstiverLogado()){
			header('Location:'.BASE.'login');
		}

	}
	public function index(){ 
		$dados=array(
			'categorias'=>array(),
			'carousel'=>array(),
			'curso_paginaçao'=>array(),
			'total_regs'=>0,
			'tem_desq'=>true
		);

		$alunos=new Alunos();
		$alunos->setAluno($_SESSION['aluno']);
		$dados['info']=$alunos;

		$cursos=new Cursos();
		//inicia a paginaçao
		$total_reg=3;
		$pagina=0;
		if(isset($_GET['pagina']) && !empty($_GET['pagina'])){
			$pagina=$_GET['pagina'];
		}
		$inicio=$pagina*$total_reg; 
		$dados['total_regs']=$cursos->contarRegistrosCursos()/$total_reg;
		$dados['curso_paginaçao']=$cursos->paginaçao($inicio,$total_reg);
		//termina paginaçao
		$cursos_destaque=$cursos->getCursosDestaque();
		$dados['cursos_cadastrados']=$cursos->getCursosDoAluno($_SESSION['aluno']);
		$dados['categorias']=$cursos->getCategorias();
		foreach($dados['categorias'] as $key=>$value){
			foreach($cursos_destaque as $value1){
				if($value1['id_categoria']==$value['id']){
					$dados['carousel'][$key][]=$value1;
				}
			}
		}
		if(!empty($cursos_destaque)){
			$dados['tem_desq']=true;
		}else{
			$dados['tem_desq']=false;
		}
		$this->loadTemplate('home',$dados);
	}
	public function cursos_entrar_view($id_curso){
		$dados=array(
			'info'=>array(),
			'curso'=>array(),
			'modulos'=>array(),
			'professor'=>array(),
			'cursos_relacionados'=>array(),
			'cursos_professor'=>array(),
			'qtCursosAlunos'=>array(),
			'qtAlunos'=>array(), 
			'comenatarios_curso'=>array(),
			'categorias'=>array()
		);
		$alunos = new Alunos();
		$alunos->setAluno($_SESSION['aluno']);
		$dados['info']=$alunos;
		$curso=new Cursos();
		$curso->setCurso($id_curso);
		$dados['categorias']=$curso->getCategorias();
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
		if(isset($_POST['comentario']) && !empty($_POST['comentario'])){
				$comentario=addslashes($_POST['comentario']);
				$curso->inserirComentarioNoCurso($_SESSION['aluno'],$id_curso,$nome,$comentario,$imagem);
				header("Location:".BASE.'home/cursos_entrar_view/'.$id_curso);
			}
		$curso->UpdateInserirComentarioNoCurso($_SESSION['aluno'],$alunos->getNome(),$alunos->getFoto());
		$dados['comentarios_curso']=$curso->Comentarios($id_curso);
		$this->loadTemplate('curso_entrar_view',$dados);
	}
	public function meus_cursos(){
		$dados=array(
			'info'=>array(),
			'cursos'=>array(),
			'categorias'=>array()
		);

		$alunos=new Alunos();
		$alunos->setAluno($_SESSION['aluno']);
		$dados['info']=$alunos;

		$cursos=new Cursos();
		$dados['cursos_cadastrados']=$cursos->getCursosDoAluno($_SESSION['aluno']);
		$dados['categorias']=$cursos->getCategorias();

		$this->loadTemplate('home_aluno',$dados);
	}
	public function conta_usuario($id_aluno){
		$dados=array(
			'info'=>array(),
			'categorias'=>array()
		);
		$aluno = new Alunos();
		$aluno->setAluno($id_aluno);
		$dados['info']=$aluno;
		$cursos=new Cursos();
		$dados['categorias']=$cursos->getCategorias();
		
		if(isset($_POST['nome']) && !empty($_POST['nome'])){
			$nome=addslashes($_POST['nome']);
			$email=addslashes($_POST['email']); 
			$senha=md5($_POST['senha']); 

			$aluno->updateAluno($id_aluno,$nome,$email,$senha);
			$aluno->setAluno($id_aluno);
			header('Location:'.BASE.'home/conta_usuario/'.$id_aluno);
		}
		if(isset($_FILES['foto_perfil']['tmp_name']) && !empty($_FILES['foto_perfil']['tmp_name'])){
			$cryptName=md5(time().rand(0,99)).'.jpg';
			$types=array('image/jpeg','image/jpg','image/png');
			if(in_array($_FILES['foto_perfil']['type'],$types)){
				move_uploaded_file($_FILES['foto_perfil']['tmp_name'],'assets/imagens/usuarios/'.$cryptName);
				
				if(!empty($aluno->getFoto())){
					unlink($_SERVER['DOCUMENT_ROOT'].'/ead/assets/imagens/usuarios/'.$aluno->getFoto());
				}

				$aluno->perfilAluno($id_aluno,$cryptName);
				$aluno->setAluno($id_aluno);
				header('Location:'.BASE.'home/conta_usuario/'.$id_aluno);
			}
		}
		$this->loadTemplate('conta_usuario',$dados);
	}
	public function ListarUsuarios(){
		$dados=array(
			'info'=>array(),
			'categorias'=>array()
		);
		$aluno = new Alunos();
		$aluno->setAluno($_SESSION['aluno']);
		$dados['info']=$aluno;
		$cursos=new Cursos();
		$dados['categorias']=$cursos->getCategorias();

		$total_reg=10;
		$pagina=0;
		if(isset($_GET['pagina']) && !empty($_GET['pagina'])){
			$pagina=$_GET['pagina'];
		}
		$inicio=$pagina*$total_reg; 
		$dados['total_regs']=$aluno->contarRegistrosAlunos()/$total_reg;
		$dados['alunos_paginaçao']=$aluno->paginaçao($inicio,$total_reg);

		$this->loadTemplate('listaUsuarios',$dados);
	}
}