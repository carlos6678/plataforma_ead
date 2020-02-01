<?php
namespace Models;
use \Core\Model;
use \Models\Grupos;
class Users extends Model{
    private $info_usuario;
    public function verificar_usuario(){
        if(!empty($_SESSION['aluno'])){
            return true;
        }
        else{
            return false;
        }
    }
    public function getIdUsuario(){
        return $this->$_SESSION['aluno'];
    }
    public function setUsuario(){
        $sql="SELECT*FROM alunos WHERE id=:id_usuario";
        $sql=$this->db->prepare($sql);
        $sql->bindValue(':id_usuario',$_SESSION['aluno']);
        $sql->execute();

        if($sql->rowCount()>0){
            $this->info_usuario=$sql->fetch(\PDO::FETCH_ASSOC);
        }
    }
    public function getNome(){
        return $this->info_usuario['nome'];
    }
    public function getGruposAtuais(){
        $grupos=array();
        $grupos=explode('|',$this->info_usuario['grupos']);
        if(count($grupos)>0){
            array_pop($grupos);
            array_shift($grupos);
            $grup=new Grupos();
            $grupos=$grup->getNomesArray($grupos);
        }
        return $grupos;
    }
    public function updateGrupos($grupos){
        $grupos_string='';
        if(count($grupos)>0){
            $grupos_string="|".implode('|',$grupos)."|";
        }
        $sql="UPDATE alunos SET ultimo_tempo=NOW(),grupos=:grupos WHERE id=:id_aluno";
        $sql=$this->db->prepare($sql);
        $sql->bindValue(':grupos',$grupos_string);
        $sql->bindValue(':id_aluno',$_SESSION['aluno']);
        $sql->execute();
    }
    public function clearGrupos(){ 
        $sql="UPDATE alunos SET grupos='' WHERE ultimo_tempo < DATE_ADD(NOW(),INTERVAL-1 MINUTE)";
        $sql=$this->db->prepare($sql);
        $sql->execute();
    }
    public function getUsuarioNoGrupo($grupo){
        $dados=array();
        $sql="SELECT nome FROM alunos WHERE grupos LIKE :grupos";
        $sql=$this->db->prepare($sql);
        $sql->bindValue(':grupos','%|'.$grupo.'|%');
        $sql->execute();
        if($sql->rowCount()>0){
            $lista=$sql->fetchAll(\PDO::FETCH_ASSOC);
            foreach($lista as $item){
                $dados[]=$item['nome'];
            }
        }
        return $dados;
    }
}