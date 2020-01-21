<?php
namespace Controllers;
use \Core\Controller;
use \Models\Modulos;
use \Models\Aulas;
use \Models\Cursos;
class AjaxController extends Controller{
    public function EditarModulo($id_modulo){
        $modulo=$_POST['nome'];
        $Modulo=new Modulos;

        $Modulo->updateModulo($modulo,$id_modulo);
    }
    public function RemoverModulo($id_modulo){
        $modulo=new Modulos();
		$modulo->deletarModulo($id_modulo);
    }
    public function RemoverAula($id_aula){
        $aula=new Aulas();
        $aula->deletarAula($id_aula);
    }
    public function VerificarAula($id_aula){
        $dados=array(
            'aula'=>array(),
            'aula_tipo'=>''
        );
        $aula=new Aulas();
		$dados['aula']=$aula->getAula($id_aula);

		if($dados['aula']['tipo']=='video'){
			$dados['aula_tipo']='Video';
		}else{
			$dados['aula_tipo']='Questionario';
        }

        header('application/json');
        echo json_encode($dados);
    }
    public function ModificarAulaVideo($id_aula){
        if(!empty($_POST['nome']) && isset($_POST['nome'])){
            $nome_aula=$_POST['nome'];
            $descricao=$_POST['descricao_aula'];
            $url_video=$_POST['url'];
            $aula=new Aulas();
            $aula->updateVideo($id_aula,$nome_aula,$descricao,$url_video);

        }
    }
    public function ModificarAulaQuestionario($id_aula){
        if(isset($_POST['pergunta'])&&!empty($_POST['pergunta'])){
			$pergunta=addslashes($_POST['pergunta']);
			$opcao1=addslashes($_POST['opcao1']);
			$opcao2=addslashes($_POST['opcao2']);
			$opcao3=addslashes($_POST['opcao3']);
			$opcao4=addslashes($_POST['opcao4']);
			$resposta=addslashes($_POST['resposta']);
			
			$aula=new Aulas();
            $aula->updateQuestionario($id_aula,$pergunta,$opcao1,$opcao2,$opcao3,$opcao4,$resposta);
        }
    }
    public function EditarCurso($id_curso){
        if(isset($_POST['nome'])&&!empty($_POST['nome'])){
			$nome=addslashes($_POST['nome']);
			$descricao=addslashes($_POST['descricao']);
			$imagem=$_FILES['imagem'];
			
			$cursos=new Cursos();
			$cursos->editarCurso($nome,$descricao,$id_curso);
			if(!empty($imagem['tmp_name'])){
				$criptyName=md5(time().rand(0,99)).'.jpg';
				$type =array('image/jpg','image/jpeg','image/png'); 

				if(in_array($imagem['type'],$type)){
					move_uploaded_file($imagem['tmp_name'],"../assets/imagens/cursos/".$criptyName);

					$cursos=new Cursos();
					$cursos->editarCursoImagem($criptyName,$id_curso);
				}
			}
		}
    }
    public function AdicionarModulo($id_curso){
        if(isset($_POST['Modulo']) && !empty($_POST['Modulo'])){
			$modulo=utf8_decode(addslashes($_POST['Modulo']));
			$modulos=new Modulos();
			$modulos->adicionarModulo($modulo,$id_curso);
		} 
    }
    public function AdicionarAula($id_curso){
        if(isset($_POST['Aula']) && !empty($_POST['Aula'])){
            echo 'hasdggh';
			$aula=addslashes($_POST['Aula']);
			$ModuloAula=$_POST['ModuloAula'];
			$tipo=$_POST['tipo'];

			$aulas= new Aulas();
			$aulas->adicionarAula($id_curso,$ModuloAula,$tipo,$aula);
		}
    }
}