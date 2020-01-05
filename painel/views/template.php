<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo BASE;?>assets/css/template.css"></link>
	<link rel="stylesheet" href="<?php echo BASE?>assets/css/bootstrap.min.css"></link>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body>
	<div class="topo">
		<?php if(!isset($_SESSION['aluno'])):?>
			<a href="<?php echo BASE_PRINCIPAL?>">
				<div>Home</div>
			</a>
		<?php endif;?>
		<?php if(isset($_SESSION['admin'])):?>
			<a href="<?php echo BASE;?>">
				<div>Cursos</div>
			</a>
		<?php endif;?>
		<?php if(isset($_SESSION['aluno'])):?>
			<a href="<?php echo BASE_PRINCIPAL?>">
				<div>Visão do Aluno</div>
			</a>
		<?php endif;?>
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
		</div>
	</div>
	<?php $this->loadInTemplate($name,$dados)?>
	<script type="text/javascript" src="<?php echo BASE;?>assets/js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE?>assets/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE;?>assets/js/script.js"></script>
</body>
</html>