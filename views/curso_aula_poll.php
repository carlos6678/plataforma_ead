<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="cursoinfo">
	<img src="<?php echo BASE;?>assets/imagens/cursos/<?php echo $curso->getImagem()?>" border="0" height="60">

	<h3><?php echo $curso->getNome()?></h3>
	<p id="calculo" data-assitido="<?php echo $aulas_ja_assistidas?>" data-total="<?php echo $total_aulas_curso?>"> </p>
</div>

<div class="esquerda">
	<?php foreach($modulos as $modulo):?>
	<div class="modulos"><?php echo utf8_encode($modulo['nome'])?></div>
		<?php foreach ($modulo['aulas'] as $aula):?>
		<a href="<?php echo BASE;?>cursos/aula/<?php echo $aula['id']?>"><div class="aulas"><?php echo utf8_encode($aula['nome'])?></div></a>
		<?php if($aula['assistida']==true):?>
			<img style="float:right;" src="../../assets/imagens/transferir.png" width="20" height="20">
			<?php endif;?>
		<?php endforeach; ?>
	<?php endforeach;?>
</div>
<div class="direita">
	<h3>Questionário</h3>
	<h1><?php echo $aula_info['pergunta']?></h1>
	<h3>Tentativas:<?php echo $_SESSION['tentativas'.$aula_info['id_aula']]?></h3>
	<?php 
	if($_SESSION['tentativas'.$aula_info['id_aula']]>2){
		echo "Voce Atingiu o limite de tentativas";
	}else{
	?>
		<form method="POST">
			<input type="radio" name="opcao" value="1" id="opcao1">
			<label for="opcao1"><?php echo $aula_info['opcao1']?></label><br><br>

			<input type="radio" name="opcao" value="2" id="opcao2">
			<label for="opcao2"><?php echo $aula_info['opcao2']?></label><br><br>

			<input type="radio" name="opcao" value="3" id="opcao3">
			<label for="opcao3"><?php echo $aula_info['opcao3']?></label><br><br>

			<input type="radio" name="opcao" value="4" id="opcao4">
			<label for="opcao4"><?php echo $aula_info['opcao4']?></label><br><br>

			<input type="submit" value="enviar">
		</form>

		<?php
		if(isset($resposta)){
			if($resposta){
				echo "Voce acertou parabens";
			}else{
				echo "Voce Errou";
			}
		}?> 
<?php }?>
</div> 
<div class="areaComentario" style="width: 80%;margin-left: 30%;padding-top: 10%">
		<div id="adicionar_comentario">
			<form method="POST">
				<label style="font-size: 50px">Comente:</label><br>
				<textarea id="comment" name="comentario" style="width: 40%"></textarea>
				<input type="submit" value="Enviar">
			</form>
		</div>
		<?php foreach($comentarios_curso as $comentario):?>
			<div class="areaComentaioUsuario" style="margin-top: 20px;">
				<?php if(!empty($comentario['foto'])):?>
					<img src="<?php echo BASE?>assets/imagens/usuarios/<?php echo $comentario['foto']?>" style="width: 30px;height: 30px;border-radius: 15px;">
				<?php else:?>
					<img src="<?php echo BASE?>assets/imagens/usuario.png" style="width: 50px;height: 50px;border-radius: 15px;">
				<?php endif;?>
				<span id="nome_usuario" style="font-size: 30px;"><?php echo $comentario['nome']?></span>
				<p id="comentario_usuario"style="margin-top: 5px;margin-left: 30px"><?php echo utf8_encode($comentario['comentario'])?>
				</p>
				<h5 style="margin-left: 30px;"><?php echo $comentario['data']?></h5>
			</div>
		<?php endforeach;?>
	</div>
</div>
<script type="text/javascript" src="../../assets/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
	$(function(){
		var aulas_ja_assistidas=$('#calculo').attr('data-assitido');
		var total_aulas_curso=$('#calculo').attr('data-total');

		var calculo=Math.ceil((aulas_ja_assistidas/total_aulas_curso)*100);
		if(aulas_ja_assistidas==0 && total_aulas_curso>0){
			$('#calculo').html("Você não assistiu nenhuma aula do curso ainda!!")
		}
		if(aulas_ja_assistidas==0 && total_aulas_curso==0){
			$('#calculo').html("Desculpe-nos mas nao adicionamos nenhum conteudo no curso, aguarde um pouco")
		}
		if(aulas_ja_assistidas>0 && total_aulas_curso>0){
			$('#calculo').html(aulas_ja_assistidas+"/"+total_aulas_curso+" ("+calculo+"%)")
		}
	})
</script>
</body>
</html>
