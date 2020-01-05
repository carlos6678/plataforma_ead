<!DOCTYPE html>
<html>
<head>
	<title>GV_EAD</title>
	<meta charset="utf-8">
</head>
<body>
	<div id="info_conta" style="margin: auto;border: 2px solid black;width: 500px;height: 500px;">
		<ul class="conta_usuario">
			<li><button id="privacidade_view">Privacidade da sua Conta</button></li>
			<li><button id="foto_perfil_view">Foto de Perfil</button></li>
		</ul>
		<div id="privacidade" style="margin-left:100px;">
			<form method="POST">
				<label>Nome:</label><br>
				<input type="text" name="nome" value="<?php echo $info->getNomeProfessor()?>"><br><br>
				<label>E-mail:</label><br>
				<input type="email" name="email" value="<?php echo $info->getEmailProfessor()?>"><br><br>
				<label>Nova senha:</label><br>
				<input type="password" name="senha" value="<?php echo $info->getSenhaProfessor()?>"><br><br>
				<input type="submit" value="Alterar" id="verificar_senha">
			</form>
		</div>
		<div id="foto_perfil">
			<?php if(!empty($info->getFotoProfessor())):?>
				<img src="<?php echo BASE?>assets/imagens/professores/<?php echo $info->getFotoProfessor()?>"style="width: 200px;height: 200px;border-radius: 100px;margin-left: 100px;">
			<?php else:?>
				<img src="<?php echo BASE_PRINCIPAL?>assets/imagens/usuario.png" style="width: 300px;height: 300px;">
			<?php endif;?>
			<form method="POST" enctype="multipart/form-data" style="margin-left: 50px;">
				<input type="file" name="foto">
				<input type="submit" value="Enviar">
			</form>
		</div>
	</div>
</body>
</html>