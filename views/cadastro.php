<!DOCTYPE html>
<html>
<head>
	<title>GV_EAD</title>
	<link rel="stylesheet" href="<?php echo BASE;?>assets/css/template.css"></link>
</head>
<body>
	<div class="topo_principal">
		<a href="<?php echo BASE;?>" class="lado_esquerdo">
			<div>Home</div>
		</a>
	</div>
	<h1>Cadastre-se na Nossa plataforma</h1>

	<fieldset>
		<form method="POST">
			<label>Nome</label><br>
			<input type="text" name="nome"><br><br>
			
			<label>E-mail</label><br>
			<input type="email" name="email"><br><br>

			<label>Senha</label><br>
			<input type="password" name="senha"><br><br>

			<input type="submit" value="Cadastrar">
		</form>
	</fieldset>
</body>
</html> 
