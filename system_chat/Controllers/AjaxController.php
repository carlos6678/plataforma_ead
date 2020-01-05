<?php
namespace Controllers;
use \Core\Controller;
use \Models\Users;
use \Models\Grupos;
use \Models\Mensagens;
class AjaxController extends Controller{
    private $usuario;
    public function __construct(){
        $dados=array(
            'estado'=>'0'
        );
        $this->usuario=new Users();
        if(!$this->usuario->verificar_usuario()){
          header('Content-Type:application/json');
          echo json_encode($dados);
          exit;
        }
    }
    public function index(){}

    public function getGrupos(){
        $dados=array('estado'=>'1');
        $grupos =new Grupos();
        $dados['lista_grupo']=$grupos->getLista();
        header('Content-Type:application/json');
        echo json_encode($dados);
        exit;
    }
    public function adicionar_mensagem(){
        $dados=array('estado'=>'1','error'=>'0');

        $msg=new Mensagens();
        if(!empty($_POST['msg']) && !empty($_POST['id_grupo'])){
            $mensagem=addslashes($_POST['msg']);
            $id_grupo=intval($_POST['id_grupo']);
            $id_usuario=$_SESSION['aluno'];

            $msg->adicionar($id_usuario,$id_grupo,$mensagem);
        }else{
            $dados['error']-'1';
            $dados['errorMSG']='Nenhuma mensagem enviada';
        }

        header('Content-Type:application/json');
        echo json_encode($dados);
        exit;
    }
    public function adicionar_foto(){
        $dados=array('estado'=>'1','error'=>'0');

        $msg=new Mensagens();
        if(!empty($_POST['id_grupo'])){
            $id_grupo=intval($_POST['id_grupo']);
            $id_usuario=$_SESSION['aluno'];

            $extencoes_permitidas=array('image/jpg','image/png','image/jpeg');
            if(!empty($_FILES['foto']['tmp_name'])){
                if(in_array($_FILES['foto']['type'],$extencoes_permitidas)){
                    $foto=$_FILES['foto'];
                    $id_grupo=$_POST['id_grupo'];
                    $hash_foto=md5(time().rand(0,99)).'.jpg';

                    move_uploaded_file($foto['tmp_name'],"media/imagens/".$hash_foto);
                    $msg->adicionar($id_usuario,$id_grupo,$hash_foto,'img');
                }else{
                    $dados['error']='1';
                    $dados['errorMSG']='extencao do arquivo nao e imagem';
                }
            }
        }else{
            $dados['error']-'1';
            $dados['errorMSG']='Grupo nao valido';
        }

        header('Content-Type:application/json');
        echo json_encode($dados);
        exit;
    }
    public function get_Mensagens(){
        $dados=array('estado'=>'1','msgs'=>array(),'ultimo_tempo'=>date('Y-m-d H:i:s'));
        $msg=new Mensagens();

        set_time_limit(60);
        $ult_msg=date('Y-m-d H:i:s');
        $ult_msg_up=date('Y-m-d H:i:s',strtotime($ult_msg)-10800);
        if(!empty($_GET['ultimo_tempo'])){
            $ult_msg_up=$_GET['ultimo_tempo'];
        }
        $grupos=array();
        if(!empty($_GET['grupos'] && is_array($_GET['grupos']))){
            $grupos=$_GET['grupos'];
        }
        $usuario=new Users();
        $usuario->updateGrupos($grupos);
        $usuario->clearGrupos();
        while(true){
            session_write_close();
            $msgs=$msg->pegar($ult_msg_up,$grupos);
            if(count($msgs)>0){
                $dados['msgs']=$msgs;
                $dados['ultimo_tempo']=date('Y-m-d H:i:s');
                break;
            }else{
                sleep(2);
                continue;
            }
        }
        header('Content-Type:application/json');
        echo json_encode($dados);
        exit;
    }
    public function get_ListaUsuarios(){
        $dados=array('estado'=>'1','usuarios'=>array());
        $grupos=array();
        if(!empty($_GET['grupos'] && is_array($_GET['grupos']))){
            $grupos=$_GET['grupos'];
        }
        $usuario=new Users();
        foreach($grupos as $grupo){
            $dados['usuarios'][$grupo]=$usuario->getUsuarioNoGrupo($grupo);
        }

        header('Content-Type:application/json');
        echo json_encode($dados);
        exit;
    } 
}  