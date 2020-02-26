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
    public function classificar_curso(){
        $classificacao=addslashes(intval($_POST['classificacao']));
        $id_curso=addslashes(intval($_POST['id_curso']));
        $curso=new Cursos();
        $curso->InserirClassificacao($id_curso,$classificacao,$_SESSION['aluno'])->mediaClass($id_curso);
    }
}