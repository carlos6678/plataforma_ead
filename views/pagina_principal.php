<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body id="back-black">
	<div class="container-fluid"> 
		<div class="row">
			<div class="col-sm-12 d-flex justify-content-center">
				<div class="jumbotron mt-5" id="dark-blue">
					<h1 class="display-4">GV_EAD</h1>
					<p class="lead">Essa plataforma foi criada para facilitar o trabalho dos professores, Mas tambem foi pensada no aluno, que por sua vez pode tirar suas duvidas com o professor atraves dessa plataforma
					</p>
					<hr style="background-color:white;"> 
					<h1 class="display-4">Aviso</h1>
					<ul class="list-group">
						<li class="list-group-item d-flex justify-content-between" id="back-black">
							<p class="lead">Precisa estar logado para ver os videos e materiais da plataforma</p>
							<a class="btn d-flex align-self-center" href="<?php echo BASE?>login/cadastro" id="dark-blue" style="color:white;font-weight:bold">Cadastrar</a>
						</li>
						<li class="list-group-item d-flex justify-content-between" id="back-black">
							<p class="lead">Qualquer um pode ser um instrutor</p>
							<a class="btn d-flex align-self-center" href="<?php echo BASE?>painel/home" id="dark-blue" style="color:white;font-weight:bold">Clique aqui</a>
						</li>
						<li class="list-group-item" id="back-black">
							<p class="lead">Sistema de chat integrado para interagir com amigos</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<?php if(!empty($carousel)):?>
			<h1>Destaques</h1> 
			<div class="row justify-content-start">
				<?php foreach($categorias as $key=>$categoria):?>
					<?php if(array_key_exists($key,$carousel)):?>
						<div class="slide carousel mr-5" data-ride="carousel" data-interval="5000" id="cursoSlide<?php echo $key?>" style="width:250px;">
							
							<div class="carousel-inner">
								
								<?php foreach($carousel[$key] as $key1=>$curso):?> 
									<?php if($categoria['id']==$curso['id_categoria']):?>
										<?php if($key1==0):?> 
											<div class="carousel-item active">
												<a  href="<?php echo BASE;?>principal_curso/entrar_view/<?php echo $curso['id']?>">
													<div class="card" id="dark-blue">
														<div class="card-header">
															<h4 align="center"><?php echo $categoria['categoria']?></h4>
														</div>
														<img  class="card-img-top img-fluid" src="<?php echo BASE;?>assets/imagens/cursos/<?php echo $curso['imagem']?>" style="height:200px;" class="w-100">
														<div class="card-body">
															<h5 class="card-title" align="center"><?php echo utf8_encode($curso['nome'])?></h3>
														</div>
													</div>
												</a>
											</div>
										<?php else:?>
											<div class="carousel-item">
												<a  href="<?php echo BASE;?>principal_curso/entrar_view/<?php echo $curso['id']?>">
														<div class="card" id="dark-blue">
															<div class="card-header">
																<h4 align="center"><?php echo $categoria['categoria']?></h4>
															</div>
															<img  class="card-img-top" src="<?php echo BASE;?>assets/imagens/cursos/<?php echo $curso['imagem']?>" style="height:200px;" class="w-100 img-fluid img-fluid">
															<div class="card-body">
																<h5 class="card-title" align="center"><?php echo utf8_encode($curso['nome'])?></h5>
															</div>
														</div>
													</a>
											</div>
										<?php endif;?>
									<?php endif;?>
								<?php endforeach;?>
							</div>
							<a href="#cursoSlide<?php echo $key?>" class="carousel-control-prev" data-slide="prev">
								<span class="carousel-control-prev-icon"></span>
							</a>
							<a href="#cursoSlide<?php echo $key?>" class="carousel-control-next" data-slide="next">
								<span class="carousel-control-next-icon"></span>
							</a>
							
						</div>
					<?php endif;?>
				<?php endforeach;?>
			</div>
		<?php endif;?>
		<?php if(!empty($curso_paginaçao)):?>
			<div class="row justify-content-center cursos">
				<nav>
					<ul class="pagination">
						<?php for($page=0;$page<=$total_regs;$page++):?>
							<li class="page-item"><a style="color:white;" id="dark-blue" class="page-link" href="?pagina=<?php echo $page?>"><?php echo $page+1?></a></li>
						<?php endfor;?>
					</ul>
				</nav>
			</div> 
			<div class="row cursos">
				<?php foreach($curso_paginaçao as $cr):?>
					<a href="<?php echo BASE?>principal_curso/entrar_view/<?php echo $cr['id']?>" class="card ml-3 mb-3" id="dark-blue">
						<img src="<?php echo BASE?>assets/imagens/cursos/<?php echo $cr['imagem']?>" class="card-img-top img-fluid" style="width:300px;height:300px;">
						<div class="card-body">
							<h5 align="center"><?php echo utf8_encode($cr['nome'])?></h5>
						</div>
					</a>
				<?php endforeach;?>
			</div>
		<?php endif;?>
	</div>
</body>
</html>