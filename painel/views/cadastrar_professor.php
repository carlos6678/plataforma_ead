<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar Professor</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?php echo BASE;?>assets/css/template.css"></link>
	<link rel="stylesheet" href="<?php echo BASE?>assets/css/bootstrap.min.css"></link>
</head>
<body id="back-black">
	<div class="container"> 
		<div class="login" id="dark-blue"> 
			<img id="img" src="<?php echo BASE_PRINCIPAL?>assets/imagens/login.jpg" style="width:120px;height:120px;border-radius:60px;position:absolute;margin-left:150px;margin-top:-90px;">
			<form method='POST' class="form-group pt-5">
				<input type="text" name="nome" placeholder="Nome" required="required" class="form-control form-control-lg"><br><br>
				<input type="email" name="email" placeholder="E-mail" required="required" class="form-control form-control-lg"><br><br>
				<input type="password" name="senha" placeholder="******" required="required" class="form-control form-control-lg"><br><br>
				<input type="submit" class="form-control form-control-lg" style="text-decoration:none;" href="<?php BASE;?>login/inscrever_como_professor" value="cadastrar">
			</form>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo BASE;?>assets/js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE;?>assets/js/script.js"></script>
	<?php if(!$dados['error']){
		echo "E-mail já existente";
	}
	?>
</html>
</body>