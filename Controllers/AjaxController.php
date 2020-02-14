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
    public function notificacoes(){
        $aluno=new Alunos;
        $notificacoes=array();
        set_time_limit(60);
        
        while(true){ 
            session_write_close();
            $notificacoes=$aluno->getNotificacoes();
            if(!empty($notificacoes)){
                break;
            }else{
                sleep(2);
                continue;
            }
        }

        header('Content-Type:application/json');
        echo json_encode($notificacoes);
    }
    public function msgLida($id_not){
        $aluno=new Alunos;
        $aluno->setMensagemLida($id_not);
    }
}