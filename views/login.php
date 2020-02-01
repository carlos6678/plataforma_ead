<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="<?php echo BASE;?>assets/css/template.css">
	<link rel="stylesheet" href="<?php echo BASE?>assets/css/bootstrap.min.css">
	<meta charset="utf-8">
</head> 
<body id="back-black">
	<div class="container">
		<div class="login" id="dark-blue"> 
			<img id="img" src="<?php echo BASE?>assets/imagens/login.jpg">
			<form method='POST' class="form-group pt-5">
				<input type="email" name="email" required="required" class="form-control form-control-lg" placeholder="E-mail">
				<br><br>
				<input type="password" name="senha" required="required" class="form-control form-control-lg" placeholder="senha">
				<br><br>
				<input type="submit" value="Logar" class="form-control form-control-lg">
				<a align="center" style="text-decoration:none;" href="<?php echo BASE?>login/cadastro" class="form-control form-control-lg">Cadastro</a>
			</form>
		</div>
	</div>
	<script src="<?php echo BASE?>assets/js/jquery-3.4.1.min.js"></script>
	<script src="<?php echo BASE?>assets/js/script.js"></script>
</body>
</html>
