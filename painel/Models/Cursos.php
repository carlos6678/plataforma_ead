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
	public function getCursoPesquisado($busca){
		$array=array();
		$sql="SELECT*,(select count(*) from aluno_curso where aluno_curso.id_curso=cursos.id) as qtAlunos FROM cursos WHERE nome LIKE :busca AND id_professor=:id";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':busca','%'.$busca.'%');
		$sql->bindValue(':id',$_SESSION['admin']);
		$sql->execute();

		if($sql->rowCount()>0){
			$array=$sql->fetchAll(\PDO::FETCH_ASSOC);
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
	public function apagarOcurso($id_curso){
		$sql="SELECT imagem FROM cursos WHERE id=:id_curso";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->execute();

		if($sql->rowCount()>0){
			$path=$sql->fetch(\PDO::FETCH_ASSOC);
			unlink($_SERVER['DOCUMENT_ROOT'].'/ead/assets/imagens/cursos/'.$path['imagem']);
		}

		$sql="DELETE FROM cursos WHERE id=:id_curso";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->execute();
		$this->apagarAlunoCurso($id_curso);
	}
	private function apagarAlunoCurso($id_curso){
		$sql="DELETE FROM aluno_curso WHERE id_curso=:id_curso";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->execute();
		$this->apagarModuloCurso($id_curso);
	}
	private function apagarModuloCurso($id_curso){
		$sql="DELETE FROM modulos WHERE id_curso=:id_curso";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->execute();
		$this->apagarAulaCurso($id_curso);
	}
	private function apagarAulaCurso($id_curso){
		$sql="SELECT id FROM aulas WHERE id_curso=:id_curso";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->execute();

		if($sql->rowCount()>0){
			$id_aulas=$sql->fetchAll(\PDO::FETCH_ASSOC);
			foreach($id_aulas as $aula){
				$sql="DELETE FROM questionarios WHERE id_aula=:id_aula";
				$sql=$this->db->prepare($sql);
				$sql->bindValue(':id_aula',$aula['id']);
				$sql->execute();

				$sql="DELETE FROM videos WHERE id_aula=:id_aula";
				$sql=$this->db->prepare($sql);
				$sql->bindValue(':id_aula',$aula['id']);
				$sql->execute();
			}
		}

		$sql="DELETE FROM aulas WHERE id_curso=:id_curso";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->execute();
		$this->apagarClassificacaoCurso($id_curso);
	}
	private function apagarClassificacaoCurso($id_curso){
		$sql="DELETE FROM classificacao WHERE id_curso=:id_curso";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->execute();
		$this->apagarComentarioCurso($id_curso);
	}
	private function apagarComentarioCurso($id_curso){
		$sql="DELETE FROM comentarios_curso WHERE id_curso=:id_curso";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->execute();exit;
	}
}