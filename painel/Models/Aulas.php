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
	public function deletarAula($id_aula){
		$sql="SELECT id_curso FROM aulas WHERE id='$id_aula'";
		$sql=$this->db->query($sql);
		if($sql->rowCount()>0){
			$row=$sql->fetch();
			$this->db->query("DELETE FROM aulas WHERE id='$id_aula'");
			$this->db->query("DELETE FROM videos WHERE id_aula='$id_aula'");
			$this->db->query("DELETE FROM questionarios WHERE id='$id_aula'");
			$this->db->query("DELETE FROM historico WHERE id='$id_aula'");
			return $row['id_curso'];
		}
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
		$sql="SELECT tipo FROM aulas WHERE id='$id_aula'";
		$sql=$this->db->query($sql);

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
	public function adicionarAula($id_curso,$modulo_aula,$tipo,$nome_aula){
		$sql="SELECT ordem FROM aulas WHERE id_modulo='$modulo_aula' ORDER BY ordem DESC LIMIT 1";
		$sql=$this->db->query($sql);
		$ordem=1;
		if($sql->rowCount()>0){
			$sql=$sql->fetch();
			$ordem=intval($sql['ordem']);
			$ordem++;
		}
		$sql="INSERT INTO aulas SET id_curso='$id_curso',id_modulo='$modulo_aula',ordem='$ordem',tipo='$tipo'";
		$this->db->query($sql);

		$id_aula=$this->db->lastInsertId();
		if($tipo=='video'){
			$sql="INSERT INTO videos SET id_aula='$id_aula',nome='$nome_aula'";
			$this->db->query($sql);
		}elseif($tipo=='poll'){
			$sql="INSERT INTO questionarios SET id_aula='$id_aula'";
			$this->db->query($sql);
		}

	}
	public function updateVideo($id_aula,$nome,$descricao,$url){
		$this->db->query("UPDATE videos SET nome='$nome',descricao='$descricao',url='$url' WHERE id_aula='$id_aula'");
	}
	public function updateQuestionario($id_aula,$pergunta,$opcao1,$opcao2,$opcao3,$opcao4,$resposta){
		$this->db->query("UPDATE questionarios SET pergunta='$pergunta',opcao1='$opcao1',opcao2='$opcao2',opcao3='$opcao3',opcao4='$opcao4',resposta='$resposta' WHERE id_aula='$id_aula' ");
		return $this->getCursoDaAula($id_aula);
	}
}