<!DOCTYPE html>
<html>
<head>  
	<title>GV_EAD</title>
	<link rel="stylesheet" href="<?php echo BASE;?>assets/css/template.css"></link>
	<link rel="stylesheet" href="<?php echo BASE;?>assets/css/bootstrap.min.css"></link>
	<script type="text/javascript" src="<?php echo BASE;?>assets/js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE;?>assets/js/bootstrap.bundle.min.js"></script>
</head> 
<body>
	<div class="container-fluid" style="background:#483D8B;">
		<nav class="navbar navbar-expand-lg justify-content-center" style="background:#483D8B;">
			<a class="navbar-brand" style="color:white;border-bottom:2px solid white;" href="<?php echo BASE;?>">PEIXOTAO_EAD</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topo_principal">
				<span class="line"></span>
				<span class="line"></span>
				<span class="line"></span>
			</button>
			<div class="navbar-collapse collapse" id="topo_principal">
				<div class="navbar-nav">
					<a class="nav-item nav-link" href="<?php echo BASE?>login">Login</a>
					<a class="nav-item nav-link" href="<?php echo BASE?>login/cadastro">Cadastrar</a>
					<a class="nav-item nav-link" href="<?php echo BASE?>painel/home">Instrutor</a>
				</div>
			</div>
			
			<div class="btn" style="color:white;border-bottom:2px solid white;">Categorias</div>
			<form method="POST" class="form-inline">
				<input type="search" class="form-control" name="busca" placeholder="Pesquisar"id="busca">
				<input type="submit" class="form-control" value ="pesquisar"></input>
			</form> 
		</nav>
	</div>

	<?php $this->loadInTemplate($name,$dados)?>
	
	<script type="text/javascript" src="<?php echo BASE;?>assets/js/script_principal.js"></script>
</body>
</html> 