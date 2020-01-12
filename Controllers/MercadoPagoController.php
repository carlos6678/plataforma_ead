<?php
namespace Controllers;
use \Core\Controller;
use \Models\Alunos;
use \Models\Compras;
use \Models\Cursos;

class MercadoPagoController extends Controller{
    public function index($id_curso){
        $dados=array('info'=>array());

        $alunos=new Alunos();
		$alunos->setAluno($_SESSION['aluno']);
        $dados['info']=$alunos;
        $curso=new Cursos();
        $curso->setCurso($id_curso);
        $compra=new Compras();

        $id_compra=$compra->createCompra($_SESSION['aluno'],$curso->getPreco(),'MercadoPago');

        $mp=new \MP('2580563479609754','Z2AyrHuvil1uEhi2SAAA2b6tuA2kfW6c');
        $data=array(
            'items'=>array(),
            'back_urls'=>array(
                'success'=>BASE.'mercadoPago/aprovado',
                'pending'=>BASE.'mercadoPago/analise',
                'failure'=>BASE.'mercadoPago/cancelado'
            ),
            'notification_url'=>BASE.'mercadoPago/notificacao/'.$id_curso,
            'auto_return'=>'all',
            'external_reference'=>$id_compra
        );
        $data['items'][]=array(
            'title'=>$curso->getNome(),
            'quantity'=>1,
            'currency_id'=>'BRL',
            'unit_price'=>floatval($curso->getPreco())
        );
        $link=$mp->create_preference($data);

        if($link['status']=='201'){
            //$link=$link['response']['init_point'];
            $link=$link['response']['sandbox_init_point'];
            header('Location:'.$link);
            exit;
        }
    }
    public function notificacao($id_curso){
        $curso=new Cursos();
        $curso->setCurso($id_curso);
        $mp=new \MP('2580563479609754','Z2AyrHuvil1uEhi2SAAA2b6tuA2kfW6c');
        $mp->sandbox_mode(true);

        $info=$mp->get_payment_info($_GET['id']);

        if($info['status']==200){
            $array=$info['response'];
            $referencia=$array['collection']['external_reference'];
            $status=$array['collection']['status'];
            if($status=="approved"){
                $curso->LiberarCursoAluno($_SESSION['aluno'],$id_curso);
                header('Location:'.BASE."cursos/entrar/".$id_curso);
            }
        }
    }
}