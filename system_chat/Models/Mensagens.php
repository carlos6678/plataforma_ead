<?php
namespace Models;
use \Core\Model;

class Mensagens extends Model{
    public function adicionar($id_usuario,$id_grupo,$mensagem,$msg_type='text'){
        $sql="INSERT INTO mensagens SET id_usuario=:id_usuario,id_grupo=:id_grupo,date_mensagem=NOW(),mensagem=:mensagem,msg_type=:msg_type";
        $sql=$this->db->prepare($sql);
        $sql->bindValue(':id_usuario',$id_usuario);
        $sql->bindValue(':id_grupo',$id_grupo);
        $sql->bindValue(':mensagem',$mensagem);
        $sql->bindValue(':msg_type',$msg_type);
        $sql->execute();
    }
    public function pegar($ultimo_tempo,$grupos){
        $array=array();
        $sql="SELECT * ,( select nome from alunos WHERE alunos.id=mensagens.id_usuario) as nomes FROM mensagens WHERE date_mensagem > :date_atual AND id_grupo IN (".implode(',',$grupos).")";
        $sql=$this->db->prepare($sql);
        $sql->bindValue(':date_atual',$ultimo_tempo);
        $sql->execute();
        if($sql->rowCount()>0){
            $array=$sql->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $array;
    }
    public function clear(){
        $dados=array();
        $sql="SELECT mensagem FROM mensagens WHERE id_usuario=:id";
        $sql=$this->db->prepare($sql);
        $sql->bindValue(':id',$_SESSION['aluno']);
        $sql->execute();

        if($sql->rowCount()>0){
            $dados=$sql->fetchAll(\PDO::FETCH_ASSOC);
        }
        $sql="DELETE FROM mensagens WHERE id_usuario=:id";
        $sql=$this->db->prepare($sql);
        $sql->bindValue(':id',$_SESSION['aluno']);
        $sql->execute();

        return $dados;
    }
}