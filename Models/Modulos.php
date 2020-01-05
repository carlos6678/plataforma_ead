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
	public function getModulosView($id_curso){
		$array=array();

		$sql="SELECT*FROM modulos WHERE id_curso='$id_curso'";
		$sql=$this->db->query($sql);

		if($sql->rowCount()>0){
			$array=$sql->fetchAll();
			$aulas=new Aulas();
			foreach ($array as $mChaves => $mDados) {
				$array[$mChaves]['aulas']=$aulas->getAulasModuloView($mDados['id']);

			}
		}

		return $array;
	}
}