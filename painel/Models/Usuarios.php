<?php
namespace Models;
use \Core\Model;
class Usuarios extends Model{
	public function EstiverLogado(){
		if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])){
			return true;
		}else{
			return false;
		}
	}
	public function existe($email,$senha){
		$sql="SELECT*FROM professor WHERE email=:email AND senha=:senha";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':email',$email);
		$sql->bindValue(':senha',$senha);
		$sql->execute();

		if($sql->rowCount()>0){
			$row = $sql->fetch();
			$_SESSION['admin']=$row['id'];
			return true;
		}else{
			return false;
		}
	}
}