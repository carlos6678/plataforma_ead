<?php
namespace Models;
use \Core\Model;
class Modulos extends Model{
	public function getModulos($id_curso){
		$array=array();

		$sql="SELECT*FROM modulos WHERE id_curso='$id_curso'";
		$sql=$this->db->query($sql);

		if($sql->rowCount()>0){
			$array=$sql->fetchAll();
			$aulas=new Aulas();
			foreach ($array as $mChaves => $mDados) {
				$array[$mChaves]['aulas']=$aulas->getAulasModulo($mDados['id']);

			}
		}

		return $array;
	}
	public function getModulo($id_modulo){
		$array=array();
		$sql="SELECT*FROM modulos WHERE id='$id_modulo'";
		$sql=$this->db->query($sql);

		if($sql->rowCount()>0){
			$array=$sql->fetch();
		}
		return $array;
	}
	public function adicionarModulo($nome,$id_curso){
		$this->db->query("INSERT INTO modulos SET id_curso='$id_curso',nome='$nome'");
	}
	public function deletarModulo($id_modulo){
		if(!empty($id_modulo)){
			$sql="SELECT id_curso FROM modulos WHERE id='$id_modulo'";
			$sql=$this->db->query($sql);
			if($sql->rowCount()>0){
				$sql=$sql->fetch();
				$this->db->query("DELETE FROM modulos WHERE id='$id_modulo'");
				return $sql['id_curso'];
			}
		}
	}
	public function updateModulo($nome,$id_modulo){
		$sql="SELECT id_curso FROM modulos WHERE id='$id_modulo'";
		$sql=$this->db->query($sql);
		if($sql->rowCount()>0){
			$sql=$sql->fetch();
			$this->db->query("UPDATE modulos SET nome='$nome' WHERE id='$id_modulo'");
			return $sql['id_curso'];
		}
	}
}