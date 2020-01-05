<?php
namespace Models;
use \Core\Model;

class Grupos extends Model{
    public function getLista(){
        $dados=array();
        $sql="SELECT*FROM grupos ORDER BY name ASC";
        $sql=$this->db->prepare($sql);
        $sql->execute();

        $dados=$sql->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getNomesArray($grupos){
        $dados=array();
        if(count($grupos)>0){
            $sql="SELECT id,name FROM grupos WHERE id IN (:grupos)";
            $sql=$this->db->prepare($sql);
            $sql->bindValue(':grupos',implode(',',$grupos));
            $sql->execute();

            if($sql->rowCount()>0){
                $dados=$sql->fetchAll(\PDO::FETCH_ASSOC);
            }
        }
        return $dados;
    }
}