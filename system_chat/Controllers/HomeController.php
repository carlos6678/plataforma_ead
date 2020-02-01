<?php
namespace Controllers;
use \Core\Controller;
use \Models\Users;
use \Models\Mensagens;
class HomeController extends Controller{
    public function __construct(){
        $dados=array();
        $usuario=new Users();
        if(!$usuario->verificar_usuario()){
          header('Location:'.BASE_PRINCIPAL.'login');
          exit;
        }
    }
    public function index(){
        $dados=array('info_usuario'=>array(),'grupos_atuais'=>array());
        $usuario=new Users();
        //$usuario->clearGrupos();
        $usuario->setUsuario();
        $dados['info_usuario']=$usuario;
        $dados['grupos_atuais']=$usuario->getGruposAtuais();
        $this->loadTemplate('home',$dados);
    }
    public function sair(){
        $msg=new Mensagens();
        $paths=$msg->clear();

        $diretorio=$_SERVER['DOCUMENT_ROOT'].'/ead/system_chat/media/imagens/';
        
        foreach($paths as $path){
            if(file_exists($diretorio.$path['mensagem']) && is_file($path['mensagem'])){
                unlink($diretorio.$path);
            }
        }

        header('Location:'.BASE_PRINCIPAL);
    }
}  