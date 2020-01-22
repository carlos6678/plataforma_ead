<?php
namespace Models;
use \Core\Model;
class Cursos extends Model{
	private $info;
	public function getCursos(){
		$array=array();
		$sql="SELECT *,(select count(*) from aluno_curso where aluno_curso.id_curso=cursos.id) as qtAlunos FROM cursos WHERE id_professor";
		$sql=$this->db->query($sql);

		if($sql->rowCount()>0){
			$array=$sql->fetchAll();
		}
		return $array; 
	}
	public function getCursosProfessor($id_professor){
		$array=array();
		$sql="SELECT *,(select count(*) from aluno_curso where aluno_curso.id_curso=cursos.id) as qtAlunos FROM cursos WHERE id_professor='$id_professor'";
		$sql=$this->db->query($sql);

		if($sql->rowCount()>0){
			$array=$sql->fetchAll();
		}
		return $array;
	}
	public function getCurso($id_curso){
		$array=array();

		$sql="SELECT*FROM cursos WHERE id='$id_curso'";
		$sql=$this->db->query($sql);

		if($sql->rowCount()>0){
			$array=$sql->fetch();
		}

		return $array;
	}
	public function adicionarCurso($nome,$imagem,$descricao,$professor,$categoria){
		$sql="INSERT INTO cursos SET nome=:nome,imagem=:imagem,descricao=:descricao,id_professor=:professor,id_categoria=:categoria";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':nome',$nome);
		$sql->bindValue(':imagem',$imagem);
		$sql->bindValue(':descricao',$descricao);
		$sql->bindValue(':professor',$professor);
		$sql->bindValue(':categoria',$categoria);
		$sql->execute();
	}
	public function editarCurso($nome,$descricao,$id){
		$this->db->query("UPDATE cursos SET nome='$nome',descricao='$descricao' WHERE id =$id");
	}
	public function editarCursoImagem($imagem,$id){
		$this->db->query("UPDATE cursos SET imagem='$imagem' WHERE id='$id'");
	}
}