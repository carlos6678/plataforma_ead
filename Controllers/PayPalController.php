<?php
namespace Controllers;
use \Core\Controller;
use \Models\Alunos;
use \Models\Cursos;
use \Models\Compras;
class PayPalController extends Controller{
    public function index($id_curso){
        $dados=array('info'=>array());
        $id_curso=$id_curso;
        $alunos=new Alunos();
		$alunos->setAluno($_SESSION['aluno']);
        $dados['info']=$alunos;
        $curso=new Cursos();
        $curso->setCurso($id_curso);
        $compra=new Compras();

        $id_compra=$compra->createCompra($_SESSION['aluno'],$curso->getPreco(),'PayPal');

        $apiContext=new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                "AbHKO-yxNwfWxJUwwfg0hijTfaWEkH646KGCR273vfwxp-Atz0Ogtiox27BV-YSo27K_9S-pUKwwV3-5",
                "EDzfXtKFG0jvtVwzt51dVnRugZMhxBzLTSHi3A0eJ4UtYvUx4Tw5v40_aw9T6-7b6qYw3b_mjnhTUiHm"
            )
        );

        $payer=new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount= new \PayPal\Api\Amount();
        $amount->setCurrency("BRL")->setTotal($curso->getPreco());

        $transaction=new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);
        $transaction->setInvoiceNumber($id_compra);

        $redirectUrls=new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(BASE."paypal/obrigado/".$id_curso);
        $redirectUrls->setCancelUrl(BASE."paypal/cancelou");

        $payment=new \PayPal\Api\Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setTransactions(array($transaction));
        $payment->setRedirectUrls($redirectUrls);

        try{
            $payment->create($apiContext);
            header("Location:".$payment->getApprovalLink());
            exit;
        }catch(\PayPal\Exception\PayPalConnectionException $e){
            echo $e->getData();exit;
        }
    }
    public function obrigado($id_curso){
        $curso=new Cursos();
        $curso->setCurso($id_curso);
        $apiContext=new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                "AbHKO-yxNwfWxJUwwfg0hijTfaWEkH646KGCR273vfwxp-Atz0Ogtiox27BV-YSo27K_9S-pUKwwV3-5",
                "EDzfXtKFG0jvtVwzt51dVnRugZMhxBzLTSHi3A0eJ4UtYvUx4Tw5v40_aw9T6-7b6qYw3b_mjnhTUiHm"
            )
        );
        $paymentId=$_GET['paymentId'];
        $payment=\PayPal\Api\Payment::get($paymentId,$apiContext);

        $execution=new \PayPal\Api\PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);

        try{
            $result=$payment->execute($execution,$apiContext);

            try{
                $payment=\PayPal\Api\Payment::get($paymentId,$apiContext);
                $status=$payment->getState();
                $t=current($payment->getTransactions());
                $t=$t->toArray();
                $ref=$t['invoice_number'];
                if($status=="approved"){
                    $curso->LiberarCursoAluno($_SESSION['aluno'],$id_curso);
                    header('Location:'.BASE."cursos/entrar/".$id_curso);
                }else{
                    header("Location:".BASE."payPal/cancelou");
                    exit;
                }
            }catch(Exception $e){
                header("Location:".BASE."payPal/cancelou");
            }
        }catch(Exception $e){
            header("Location:".BASE."payPal/cancelou");
            exit;
        }
    }
    public function cancelou(){
        $this->loadView('PayPal_cancelado');
    }
}