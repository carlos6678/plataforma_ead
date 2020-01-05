<?php
namespace Models;
use \Core\Model;
class Alunos extends Model{
	private $info;
	public function EstiverLogado(){
		if(isset($_SESSION['aluno']) && !empty($_SESSION['aluno'])){
			return true;
		}else{
			return false;
		}
	}
	public function existe($email,$senha){
		$sql="SELECT*FROM alunos WHERE email=:email AND senha=:senha";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':email',$email);
		$sql->bindValue(':senha',$senha);
		$sql->execute();

		if($sql->rowCount()>0){
			$row = $sql->fetch();
			$_SESSION['aluno']=$row['id'];
			$_SESSION['usuario_hash']=md5(time().rand(0,99));
			$hash=$_SESSION['usuario_hash'];
			$user=$_SESSION['aluno'];
			$this->db->query("UPDATE alunos SET hash_usuario='$hash' WHERE id='$user'");
			return true;
		}else{
			return false;
		}
	}
	public function EmailExiste($email){
		$sql="SELECT*FROM alunos WHERE email=':email'";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':email',$email);
		$sql->execute();

		if($sql->rowCount()>0){
			return true;
		}else{
			return false;
		}
	}
	public function setAluno($id){
		$sql="SELECT*FROM alunos WHERE id='$id'";
		$sql=$this->db->query($sql);

		if($sql->rowCount()>0){
			$this->info=$sql->fetch();
		}
	}
	public function getNome(){
		return $this->info['nome'];
	}
	public function getEmail(){
		return $this->info['email'];
	}
	public function getSenha(){
		return $this->info['senha'];
	}
	public function getFoto(){
		return $this->info['foto_perfil'];
	}
	public function EstaInscrito($id_curso){
		$sql="SELECT*FROM aluno_curso WHERE id_aluno=:id_aluno AND id_curso=:id_curso";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_aluno',$this->info['id']);
		$sql->bindValue(':id_curso',$id_curso);
		$sql->execute();
		if($sql->rowCount()>0){
			return true;
		}else{
			return false;
		}
	}
	public function cadastrarAluno($nome,$email,$senha){
		$this->db->query("INSERT INTO alunos SET nome='$nome',email='$email',senha='$senha'");
	}
	public function updateAluno($id_aluno,$nome,$email,$senha){
		$this->db->query("UPDATE alunos SET nome='$nome',email='$email',senha='$senha' WHERE id='$id_aluno'");
	}
	public function perfilAluno($id_aluno,$imagem){
		$this->db->query("UPDATE alunos SET foto_perfil='$imagem' WHERE id='$id_aluno'");
	}
}