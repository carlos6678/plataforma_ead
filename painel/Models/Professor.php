<?php
namespace Models;
use \Core\Model;
class Professor extends Model{
	private $info;
	public function EmailExiste($email){
		$sql="SELECT*FROM professor WHERE email=:email";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':email',$email);
		$sql->execute();

		if($sql->rowCount()>0){
			return true;
		}else{
			return false;
		}
	}
	public function cadastrarProfessor($email,$senha,$nome){
		$this->db->query("INSERT INTO professor SET email='$email',senha='$senha',nome='$nome'");
	}
	public function setProfessor($id_professor){
		$sql="SELECT*FROM professor WHERE id=:id_professor";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_professor',$id_professor);
		$sql->execute();

		if($sql->rowCount()>0){
			$this->info=$sql->fetch(\PDO::FETCH_ASSOC);
		}
	}
	public function getIdProfessor(){
		return $this->info['id'];
	}
	public function getNomeProfessor(){
		return $this->info['nome'];
	}
	public function getEmailProfessor(){
		return $this->info['email'];
	}
	public function getFotoProfessor(){
		return $this->info['foto'];
	}
	public function getDescricao(){
		return $this->info['descricao'];
	}
	public function updateProfessor($id_professor,$nome,$email,$descricao,$senha){
		$this->db->query("UPDATE professor SET nome='$nome',email='$email',descricao='$descricao',senha='$senha' WHERE id='$id_professor'");
	}
	public function perfilProfessor($id_professor,$imagem){
		$this->db->query("UPDATE professor SET foto='$imagem' WHERE id='$id_professor'");
	}
}