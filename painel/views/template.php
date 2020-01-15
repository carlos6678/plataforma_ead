<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo BASE;?>assets/css/template.css"></link>
	<link rel="stylesheet" href="<?php echo BASE?>assets/css/bootstrap.min.css"></link>
	<script type="text/javascript" src="<?php echo BASE;?>assets/js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE?>assets/js/bootstrap.bundle.min.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body id="back-black">
	<div class="container-fluid" id="dark-blue">
		<nav class="navbar navbar-expand-lg" id="dark-blue">
			<a class="navbar-brand" href="<?php echo BASE?>">PEIXOTAO_EAD</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navprof">
				<span class="line"></span>
				<span class="line"></span>
				<span class="line"></span>
			</button>
			<div class="collapse navbar-collapse" id="navprof">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<?php if(!isset($_SESSION['aluno'])):?>
							<a class="nav-link" href="<?php echo BASE_PRINCIPAL?>">
								Pagina inicial
							</a>
						<?php endif;?>
					</li>
					<li class="nav-item">
						<?php if(isset($_SESSION['aluno'])):?>
							<a class="nav-link" href="<?php echo BASE_PRINCIPAL?>">
								<div>Visão do Aluno</div>
							</a>
						<?php endif;?>
					</li>
					<li class="nav-item dropdown">
						<?php if(!empty($dados['info']->getFotoProfessor())):?>
							<a class="dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"><img src="<?php echo BASE?>assets/imagens/professores/<?php echo $dados['info']->getFotoProfessor();?>" style="width: 40px;height: 40px;border-radius: 20px;"></a>
						<?php else:?>
							<img class="dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false" src="<?php echo BASE_PRINCIPAL?>assets/imagens/usuario.png" style="width: 40px;height: 40px">
						<?php endif;?>
						<div class="dropdown-menu" id="back-black" aria-labelledby="navbarDropdown">
							<a style="color:white;" class="dropdown-item" href="<?php echo BASE?>home/editarContaProfessor/<?php echo $_SESSION['admin']?>">Conta</a>
							<a style="color:white;" class="dropdown-item" href="<?php echo BASE?>login/logout">Sair</a>
						</div>
					</li>
				</ul>
				<form method="post" class="form-inline">
					<input type="text" class="form-control">
					<input type="submit" class="form-control" value="Pesquisar">
				</form>
			</div>
		</nav>
	</div>

	<?php $this->loadInTemplate($name,$dados)?>
	<script type="text/javascript" src="<?php echo BASE;?>assets/js/script.js"></script>
</body>
</html>
<!--
	<div class="professor">
	<?php if(isset($_SESSION['admin'])):?>
				<?php if(!empty($dados['info']->getFotoProfessor())):?>
					<div style="float: right;"><img src="<?php echo BASE?>assets/imagens/professores/<?php echo $dados['info']->getFotoProfessor();?>" style="width: 40px;height: 40px;border-radius: 20px;"></div>
				<?php else:?>
					<div style="float: right;"><img src="<?php echo BASE_PRINCIPAL?>assets/imagens/usuario.png" style="width: 60px;height: 60px"></div>
				<?php endif;?>
			<?php endif;?>
			<div id="professor">
				<ul>
					<li><a href="<?php echo BASE?>home/editarContaProfessor/<?php echo $_SESSION['admin']?>">Conta</a></li>
					<li><a href="<?php echo BASE?>login/logout">Sair</a></li>
				</ul>
			</div>
		</div>-->