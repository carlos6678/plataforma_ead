<?php
namespace Models;
use \Core\Model;
class Aulas extends Model{
	private $info;
	public function getAulasModulo($id_modulo){
		$array=array();
		$sql="SELECT*FROM aulas WHERE id_modulo='$id_modulo' ORDER BY ordem";
		$sql=$this->db->query($sql);

		if($sql->rowCount()>0){
			$array=$sql->fetchAll();

			foreach ($array as $aulaKey => $aula) {
				$array[$aulaKey]['assistida']=$this->isAssistido($aula['id'],$_SESSION['aluno']);
				if($aula['tipo']==='video'){
					$sql="SELECT nome FROM videos WHERE id_aula='".$aula['id']."'";
					$sql=$this->db->query($sql)->fetch();

					$array[$aulaKey]['nome']=$sql['nome'];
				}elseif($aula['tipo']==='poll'){
					$array[$aulaKey]['nome']='Questionario';
				}
			}
		} 
		return $array;
	}
	public function getAulasModuloView($id_modulo){
		$array=array();
		$sql="SELECT*FROM aulas WHERE id_modulo='$id_modulo' ORDER BY ordem";
		$sql=$this->db->query($sql);

		if($sql->rowCount()>0){
			$array=$sql->fetchAll();

			foreach ($array as $aulaKey => $aula) {
				if($aula['tipo']==='video'){
					$sql="SELECT nome FROM videos WHERE id_aula='".$aula['id']."'";
					$sql=$this->db->query($sql)->fetch();

					$array[$aulaKey]['nome']=$sql['nome'];
				}elseif($aula['tipo']==='poll'){
					$array[$aulaKey]['nome']='Questionario';
				}
			}
		}
		return $array;
	}
	public function getCursoDaAula($id_aula){
		$array=array();
		$sql="SELECT id_curso FROM aulas WHERE id='$id_aula'";
		$sql=$this->db->query($sql);

		if($sql->rowCount()>0){
			$resp=$sql->fetch();
			return $resp['id_curso'];
		}else{
			return ;
		}
	}
	public function getAula($id_aula){
		$array=array();
		$sql="SELECT tipo FROM aulas WHERE id=:id_aula";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(":id_aula",$id_aula);
		$sql->execute();

		if($sql->rowCount()>0){
			$row=$sql->fetch();

			if($row['tipo']==='video'){
				$sql="SELECT*FROM videos WHERE id_aula='$id_aula'";
				$sql=$this->db->query($sql);
				$array=$sql->fetch();
				$array['tipo']='video';
			}elseif($row['tipo']==='poll'){
				$sql="SELECT*FROM questionarios WHERE id_aula='$id_aula'";
				$sql=$this->db->query($sql);
				$array=$sql->fetch();
				$array['tipo']='poll';
			}
		}
		return $array;
	}
	private function isAssistido($id_aula,$id_aluno){
		$sql="SELECT id FROM historico WHERE id_aluno=:id_aluno AND id_aula=:id_aula";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':id_aluno',$id_aluno);
		$sql->bindValue('id_aula',$id_aula);
		$sql->execute();

		if($sql->rowCount()>0){
			return true;
		}else{
			return false;
		}
	}
}