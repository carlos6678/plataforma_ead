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
			'aluno_info'=>array(),
			'cursos'=>array(),
			'categorias'=>array(),
			'carousel'=>array(),
			'curso_paginaçao'=>array(),
			'total_regs'=>0
		);

		$alunos=new Alunos();
		$alunos->setAluno($_SESSION['aluno']);
		$dados['info']=$alunos;

		$cursos=new Cursos();
		//inicia a paginaçao
		$total_reg=3;
		$pagina=1;
		if(isset($_GET['pagina']) && !empty($_GET['pagina'])){
			$pagina=$_GET['pagina'];
		}
		$inicio=$pagina-1; 
		$inicio=$inicio*$total_reg;
		$dados['total_regs']=$cursos->contarRegistrosCursos()/$total_reg;
		$dados['curso_paginaçao']=$cursos->paginaçao($inicio,$total_reg);
		//termina paginaçao
		$dados['cursos']=$cursos->getCursos();
		$dados['cursos_cadastrados']=$cursos->getCursosDoAluno($_SESSION['aluno']);
		$dados['categorias']=$cursos->getCategorias();
		foreach($dados['categorias'] as $key=>$value){
			foreach($dados['cursos'] as $value1){
				if($value1['id_categoria']==$value['id']){
					$dados['carousel'][$key][]=$value1;
				}
			}
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
			'comenatarios_curso'=>array()
		);
		$alunos = new Alunos();
		$alunos->setAluno($_SESSION['aluno']);
		$dados['info']=$alunos;
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

		$this->loadTemplate('home_aluno',$dados);
	}
	public function conta_usuario($id_aluno){
		$dados=array(
			'info'=>array()
		);
		$aluno = new Alunos();
		$aluno->setAluno($id_aluno);
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
				$aluno->perfilAluno($id_aluno,$cryptName);
				$aluno->setAluno($id_aluno);
				header('Location:'.BASE.'home/conta_usuario/'.$id_aluno);
			}
		}
		$dados['info']=$aluno;
		$this->loadTemplate('conta_usuario',$dados);
	}
	public function historico_compras(){
		$dados=array(
			'info'=>array(),
			'compras'=>array()
		);
		$aluno = new Alunos();
		$aluno->setAluno($_SESSION['aluno']);
		$dados['info']=$aluno;
		$dados['compras']=$aluno->Historico_Compras();

		$this->loadTemplate("compras",$dados);
	}
	public function pagamentos($id_curso){ 
		if(!empty($_POST['pagamento'])){
			$pagamento_tipo=$_POST['pagamento'];
			switch($pagamento_tipo){
				case "MercadoPago":
					header("Location:".BASE."mercadoPago/index/".$id_curso);
					exit;
					break;
				case "PayPal":
					header("location:".BASE."paypal/index/".$id_curso);
					exit;
					break;
			}
		}
	}
}