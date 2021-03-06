<?php
namespace Models;
use \Core\Model;
class Cursos extends Model{
	private $info;
	public function getCursosDoAluno($id){
		$curso=array();
		$sql="SELECT aluno_curso.id_curso,cursos.nome,cursos.imagem,cursos.descricao,cursos.id FROM aluno_curso LEFT JOIN cursos ON aluno_curso.id_curso=cursos.id WHERE aluno_curso.id_aluno='$id'";
		$sql=$this->db->query($sql);

		if($sql->rowCount()>0){
			$curso=$sql->fetchAll();
		}
		return $curso;
	} 
	public function getCursos(){
		$array=array();

		$sql="SELECT* FROM cursos ORDER BY classificacao DESC";
		$sql=$this->db->prepare($sql);
		$sql->execute();

		if($sql->rowCount()>0){
			$array=$sql->fetchAll();
		}
		return $array;
	}
	public function getCursosDestaque(){ 
		$array=array();

		$sql="SELECT* FROM cursos WHERE classificacao=:s";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':s',5);
		$sql->execute();
		if($sql->rowCount()>0){
			$array=$sql->fetchAll();
		}
		return $array; 
	}
	public function paginaçao($inicio,$total_reg){
		$array=array();
		$sql="SELECT*FROM cursos ORDER BY classificacao DESC LIMIT $inicio,$total_reg";
		$sql=$this->db->query($sql);
		if($sql->rowCount()>0){
			$array=$sql->fetchAll();
			return $array;
		}
		return $array;
	}
	public function contarRegistrosCursos(){
		$sql="SELECT COUNT(*) as total FROM cursos";
		$sql=$this->db->prepare($sql);
		$sql->execute();
		if($sql->rowCount()>0){
			$array=$sql->fetch();
			return $array['total'];
		}
	}
	public function getCategorias(){
		$array=array();

		$sql="SELECT*FROM categorias";
		$sql=$this->db->query($sql);
		if($sql->rowCount()>0){
			$array=$sql->fetchAll();
		}
		return $array;
	}
	public function setCurso($id){
		$sql="SELECT*FROM cursos WHERE id=:id";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id',$id);
		$sql->execute();

		if($sql->rowCount()>0){
			$this->info=$sql->fetch();
		}
	}
	public function setCompra($id_compra){
		$sql="UPDATE cursos SET id_compra=:id_compra";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_compra',$id_compra);
		$sql->execute();
	}
	public function getNome(){
		return $this->info['nome'];
	}
	public function getImagem(){
		return $this->info['imagem'];
	}
	public function getDescricao(){
		return $this->info['descricao'];
	}
	public function getIdCurso(){
		return $this->info['id'];
	}
	public function getClassificacao(){
		return $this->info['classificacao'];
	}
	public function getTotalAulasCurso(){
		$sql="SELECT id FROM aulas WHERE id_curso='".($this->getIdCurso())."'";
		$sql=$this->db->query($sql);

		return $sql->rowCount();
	}
	public function getCursosDoProfessor($id_professor){
		$array=array();
		$sql="SELECT*FROM cursos WHERE id_professor=:id_professor";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_professor',$id_professor);
		$sql->execute();
		if($sql->rowCount()>0){
			$array=$sql->fetchAll();
			return $array;
		}
		return $array;
	}
	public function cadastrarNoCurso($id_curso,$id_aluno){
		$this->db->query("INSERT INTO aluno_curso SET id_curso='$id_curso',id_aluno='$id_aluno'");
	}
	public function getIdProfessor($id_curso){
		$sql="SELECT id_professor FROM cursos WHERE id=:id_curso";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->execute();
		if($sql->rowCount()>0){
			$row=$sql->fetch();
			return $row['id_professor'];

		}
	}
	public function getProfessor($id_professor){
		$array=array();
		$sql="SELECT*,(select count(*) from cursos where cursos.id_professor=professor.id) as qtCursos FROM professor WHERE id=:id_professor";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_professor',$id_professor);
		$sql->execute();

		if($sql->rowCount()>0){
			$array=$sql->fetchAll();
			return $array;
		}
		return $array;
	}
	public function getProfessorIdCursos($id_professor){
		$array=array();
		$sql="SELECT id FROM cursos WHERE id_professor=:id_professor";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_professor',$id_professor);
		$sql->execute();

		if($sql->rowCount()>0){
			$array=$sql->fetchAll();
			return $array;
		}
		return $array;
	}
	public function getQuantidadeDeAlunosProfessor($id_curso){
		$array=array();
		$sql="SELECT * FROM aluno_curso WHERE id_curso=:id_curso";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->execute();

		if($sql->rowCount()>0){
			$array=$sql->fetchAll();
			return $array;
		}
		return $array;
	} 
	public function inserirComentarioNoCurso($id_aluno,$id_curso,$nome,$comentario,$imagem){
		$sql="INSERT INTO comentarios_curso SET id_aluno=:id_aluno,id_curso=:id_curso,nome=:nome,comentario=:comentario,foto=:imagem,data=NOW()";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_aluno',$id_aluno);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->bindValue(':nome',$nome);
		$sql->bindValue(':comentario',$comentario);
		$sql->bindValue(':imagem',$imagem);
		$sql->execute();
	}
	public function Comentarios($id_curso){
		$array=array();
		$sql="SELECT*FROM comentarios_curso WHERE id_curso=:id_curso ORDER BY data DESC";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->execute();

		if($sql->rowCount()>0){
			$array=$sql->fetchAll();
			return $array; 
		}
		return $array;
	} 
	public function UpdateInserirComentarioNoCurso($id_aluno,$nome,$imagem){
		$this->db->query("UPDATE comentarios_curso SET foto='$imagem',nome='$nome' WHERE id_aluno='$id_aluno'");
	}
	public function LiberarCursoAluno($id_aluno,$id_curso){
		$sql="INSERT INTO aluno_curso SET id_curso=:id_curso,id_aluno=:id_aluno";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(":id_curso",$id_curso);
		$sql->bindValue(":id_aluno",$id_aluno);
		$sql->execute();
	}
	public function getNomeCategoria($id_categoria){
		$sql="SELECT categoria FROM categorias WHERE id=:id";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id',$id_categoria);
		$sql->execute();

		if($sql->rowCount()>0){
			$cat=$sql->fetch();
			return $cat['categoria'];
		}
	}
	public function getCursoPesquisado($busca,$id_categoria=0){
		$array=array();
		$sql='';
		if($id_categoria==0){
			$sql="SELECT*FROM cursos WHERE nome LIKE :busca";
			$sql=$this->db->prepare($sql);
			$sql->bindValue(':busca','%'.$busca.'%');
			$sql->execute();
		}else{
			$sql="SELECT*FROM cursos WHERE id_categoria=:id AND nome LIKE :busca";
			$sql=$this->db->prepare($sql);
			$sql->bindValue(':id',$id_categoria);
			$sql->bindValue(':busca','%'.$busca.'%');
			$sql->execute();
		}

		if($sql->rowCount()>0){
			$array=$sql->fetchAll(\PDO::FETCH_ASSOC);
		}
		return $array;
	}
	public function InserirClassificacao($id_curso,$classificacao,$id_aluno){
		$sql="INSERT INTO classificacao SET id_curso=:id_curso,c_val=:classificacao,id_aluno=:id_aluno";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->bindValue(':classificacao',$classificacao);
		$sql->bindValue(':id_aluno',$id_aluno);
		$sql->execute();
		return $this;
	}
	public function mediaClass($id_curso){
		$sql="SELECT COUNT(*) as qt,SUM(c_val) as total FROM classificacao WHERE id_curso=:id_curso";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->execute();

		if($sql->rowCount()>0){
			$sql=$sql->fetch();
			$qt=$sql['qt']; 
			$total=$sql['total'];
			$this->InserirClassificacaoCurso(intval($qt),intval($total),$id_curso);
		}
	}
	private function InserirClassificacaoCurso($qt,$total,$id_curso){
		$classificacao=intval(floor($total/$qt));
		$sql="UPDATE cursos SET classificacao=:classificacao WHERE id=:id_curso";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':classificacao',$classificacao);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->execute();
	}
}