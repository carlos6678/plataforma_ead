<!DOCTYPE html>
<html>
<head>  
	<title>GV_EAD</title>
	<link href="https://fonts.googleapis.com/css?family=Bangers|Noticia+Text|Saira+Condensed:300|ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo BASE;?>assets/css/template.css"></link>
	<link rel="stylesheet" href="<?php echo BASE;?>assets/css/bootstrap.min.css"></link>
	<link rel="stylesheet" href="https://cdn.plyr.io/3.5.6/plyr.css"/>
	<script type="text/javascript" src="<?php echo BASE;?>assets/js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE;?>assets/js/bootstrap.bundle.min.js"></script>
</head> 
<body>
	<div class="container-fluid" id="dark-blue">
		<nav class="navbar navbar-expand-lg justify-content-center" id="dark-blue">
			<a class="navbar-brand logo" href="<?php echo BASE;?>">PEIXOTAO_EAD</a>
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
			<form method="GET" class="form-inline" action="<?php echo BASE?>Busca">
				<input type="search" class="form-control" name="busca" value="<?php echo (!empty($dados['busca'])?$dados['busca']:'')?>" placeholder="Pesquise aqui" id="busca" required="required">
				<input style="background-color:white;color:black;border:none;" type="submit" class="btn" value ="pesquisar"></input>
				<select name="categoria" class="btn">
					<option class="dropdown-item"value="0">Todas categorias</option>
					<?php foreach($dados['categorias'] as $categoria):?>
						<option class="w-75"<?php echo (!empty($dados['categoria_ativa']) && $dados['categoria_ativa']==$categoria['id']?'selected':'')?> value="<?php echo $categoria['id']?>"><?php echo $categoria['categoria']?></option>
					<?php endforeach;?>
				</select>
			</form>
		</nav>
	</div>

	<?php $this->loadInTemplate($name,$dados)?>
	<footer style="clear:both;">
		<div class="rodape">
			<div class="jumbotron">
				<h3 class="display-4">Suporte</h3>
				<h5>sandramariagv11@gmail.com</h5>
				<h5>Aleixandre Peixoto e responsável por esse sistema</h5>
				<a href="https://www.facebook.com/profile.php?id=100011563714434">
					<img src="<?php echo BASE?>assets/imagens/facebook.jpg" style="width:50px;height:50px;">
				</a>
			</div>
			<div class="jumbotron">
				<h1>Seja um Instrutor você também</h1>
				<a href="<?php echo BASE?>painel" class="btn btn-lg w-100">Clique aqui!</a>
			</div>
		</div>
	</footer>
	<script src="<?php echo BASE?>assets/js/script.js"></script>
</body>
</html> 