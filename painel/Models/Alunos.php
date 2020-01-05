<?php
namespace Models;
use \Core\Model;
class Alunos extends Model{
	private $info;
	public function getAlunos(){
		$array=array();
		$sql="SELECT *,(select count(*) from aluno_curso where aluno_curso.id_aluno=alunos.id) as qtCursos FROM alunos";
		$sql=$this->db->query($sql);

		if($sql->rowCount()>0){
			$array=$sql->fetchAll();
		}
		return $array;
	}
	public function deletarAluno($id_aluno){
		$sql="DELETE FROM aluno_curso WHERE id_aluno='$id_aluno'";
		$this->db->query($sql);

		$sql="DELETE FROM alunos WHERE id='$id_aluno'";
		$this->db->query($sql);
	}
	public function adicionarAluno($nome,$email,$senha){
		$this->db->query("INSERT INTO alunos SET nome='$nome',email='$email',senha='$senha'");
	}
	public function getAluno($id_aluno){
		$array=array();
		$sql=$this->db->query("SELECT*FROM alunos WHERE id='$id_aluno'");
		if($sql->rowCount()>0){
			$array=$sql->fetch();
			return $array;
		}
	}
	public function updateAluno($id_aluno,$nome,$email,$senha,$cursos){
		$this->db->query("UPDATE alunos SET nome='$nome',email='$email',senha='$senha' WHERE id='$id_aluno'"); 
		$this->db->query("DELETE FROM aluno_curso WHERE id_aluno='$id_aluno'");
		foreach($cursos as $curso){
			$this->db->query("INSERT INTO aluno_curso SET id_curso='$curso',id_aluno='$id_aluno'");
		}
	}
}