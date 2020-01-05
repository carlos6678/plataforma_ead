<?php
namespace Models;
use \Core\Model;

class Compras extends Model{
    public function createCompra($id_usuario,$total,$tipo){
        $sql="INSERT INTO compras SET id_usuario=:id_usuario,total_compra=:total,tipo_pagamento=:tipo,status_pagamento=1";
        $sql=$this->db->prepare($sql);
        $sql->bindValue(':id_usuario',$id_usuario);
        $sql->bindValue(':total',$total);
        $sql->bindValue(':tipo',$tipo);
        $sql->execute();

        return $this->db->lastInsertId();
    }
}