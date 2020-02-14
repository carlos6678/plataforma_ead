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
				<?php if(!empty($info->getFoto())):?>
					<img class="mr-3 img-fluid" src="<?php echo BASE?>assets/imagens/usuarios/<?php echo $info->getFoto()?>"style="width: 200px;height: 200px;border-radius: 100px;margin-left: 100px;">
				<?php else:?>
					<img class="mr-3" src="<?php echo BASE?>assets/imagens/usuario.png" style="width: 300px;height: 300px;">
				<?php endif;?>
				<div class="media-body">
					<form method="POST" class="form-group" id="teste">
						<label>Nome:</label><br>
						<input class="form-control" type="text" name="nome" value="<?php echo $info->getNome()?>"><br><br>
						<label>E-mail:</label><br>
						<input class="form-control" type="email" name="email" value="<?php echo $info->getEmail()?>"><br><br>
						<label>Nova senha:</label><br>
						<input class="form-control" type="password" name="senha"><br><br>
						<input class="form-control" type="submit" value="Salvar alterações">
					</form>
					<button class="btn btn-dark" id="uploadFoto">Trocar foto</button>
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