<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>
	<link rel="stylesheet" href="<?php echo BASE;?>assets/css/template.css">
	<link rel="stylesheet" href="<?php echo BASE?>assets/css/bootstrap.min.css">
	<meta charset="utf-8">
</head> 
<body id="back-black">
	<div class="container">
		<div class="login" id="dark-blue">
			<img id="img" src="<?php echo BASE?>assets/imagens/login.jpg">
			<h3 style="position:absolute;">Seja um Aluno</h3>
			<form method='POST' class="form-group pt-5">
				<input type="text" name="nome" placeholder="Nome de Usuario" class="form-control form-control-lg" required="required"><br><br>
				<input type="email" name="email" placeholder="E-mail" required="required" class="form-control form-control-lg"><br><br>
				<input type="password" name="senha" placeholder="******" required="required" class="form-control form-control-lg"><br><br>
				<input type="submit" value="Cadastrar" class="form-control form-control-lg">
			</form>
		</div>
	</div>
	<script src="<?php echo BASE?>assets/js/jquery-3.4.1.min.js"></script>
	<script src="<?php echo BASE?>assets/js/script.js"></script>
</body>
</html>
