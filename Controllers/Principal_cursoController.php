<?php
namespace Controllers;
use \Models\Cursos;
use \Models\Modulos;
use \Core\Controller; 
class Principal_cursoController extends Controller{
	public function entrar_view($id_curso){
		$dados=array(
			'curso'=>array(),
			'modulos'=>array(),
			'professor'=>array(),
			'qtCursosAlunos'=>array(),
			'qtAlunos'=>array(),
			'comentarios_curso'=>array(),
			'cursos_relacionados'=>array()
		); 

		$curso=new Cursos();
		$curso->setCurso($id_curso);
		$dados['curso']=$curso;
		$id_professor=$curso->getIdProfessor($id_curso);
		$modulos=new Modulos();
		$dados['modulos']=$modulos->getModulosView($id_curso);

		$dados['professor']=$curso->getProfessor($id_professor);
		$dados['cursos_relacionados']=$curso->getCursosDoProfessor($id_professor);
		$dados['cursos_professor']=$curso->getProfessorIdCursos($id_professor);

		foreach ($dados['cursos_professor'] as $keyCurso =>$num_curso) {
			$dados['qtCursosAlunos'][$keyCurso]=$curso->getQuantidadeDeAlunosProfessor($num_curso['id']);

			foreach ($dados['qtCursosAlunos'][$keyCurso] as $keyAluno => $value) {
				array_push($dados['qtAlunos'], $value['id_aluno']);
			}
				
		}
		$dados['comentarios_curso']=$curso->Comentarios($id_curso);
		$this->loadPrincipalTemplate('curso_entrar_view',$dados);
		
	}
}