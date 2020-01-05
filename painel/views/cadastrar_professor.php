<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar Professor</title>
	<meta charset="utf-8">
</head>
<body>
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
	<?php if(!$dados['error']){
		echo "E-mail já existente";
	}
	?>
</html>
</body>