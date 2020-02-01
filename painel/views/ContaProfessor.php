<!DOCTYPE html>
<html>
<head>
	<title>GV_EAD</title>
	<meta charset="utf-8">
</head>
<body id="back-black">
	<div class="container" style="color:white;">
		<h1>Seu perfil</h1>
		<div class="row mt-5">
			<div class="media">
				<?php if(!empty($info->getFotoProfessor())):?>
					<img id="img_user" class="mr-3 img-fluid" src="<?php echo BASE?>assets/imagens/professores/<?php echo $info->getFotoProfessor()?>"style="width: 200px;height: 200px;border-radius: 100px;margin-left: 100px;">
				<?php else:?>
					<img id="img_user"class="mr-3" src="<?php echo BASE?>assets/imagens/usuario.png" style="width: 300px;height: 300px;">
				<?php endif;?>
				<div class="media-body">
					<form method="POST" class="form-group">
						<label>Nome:</label><br>
						<input class="form-control" type="text" name="nome" value="<?php echo $info->getNomeProfessor()?>"><br><br>
						<label>E-mail:</label><br>
						<input class="form-control" type="email" name="email" value="<?php echo $info->getEmailProfessor()?>"><br><br>
						<label>Nova senha:</label><br>
						<input class="form-control" type="password" name="senha"><br><br>
						<label>Adicione uma biografia</label><br>
						<textarea name="descricao" cols="50" rows="5" placeholder="Opcional"?></textarea>
						<input class="form-control" type="submit" value="Salvar alterações" id="verificar_senha">
					</form>
					<button class="btn" id="uploadFoto">Trocar foto</button>
				</div>
			</div>
		</div>
	</div>
	
	<form method="POST" enctype="multipart/form-data" style="position:absolute;top:-1000px;">
		<input type="file" name="foto_perfil" id="escolher">
		<input type="submit" value="Enviar" id="enviar">
	</form>
</body>
</html>