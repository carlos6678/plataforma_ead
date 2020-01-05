<?php
namespace Controllers;
use \Models\Alunos;
use \Models\Aulas;
use \Models\Cursos;
class AjaxController{
    public function LiberarCursoGratis(){
        $id_usuario=addslashes($_POST['id_aluno']);
        $id_curso=addslashes($_POST['id_curso']);
        $curso=new Cursos();
        $curso->LiberarCursoAluno($id_usuario,$id_curso);exit;
    }
}