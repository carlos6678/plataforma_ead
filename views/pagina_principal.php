<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body id="back-black">
	<div class="container-fluid"> 
		<div class="row mt-2">
			<div class="col-sm-12 d-flex justify-content-center">
				<img class="w-50" src="<?php echo BASE?>assets/imagens/animado.gif">
			</div>
		</div>
		<h1>Destaques</h1>
		<div class="row justify-content-center">
			<?php foreach($categorias as $key=>$categoria):?>
				<div class="col-sm-3">
					<div class="slide carousel ml-2" data-ride="carousel" data-interval="5000" id="cursoSlide<?php echo $key?>" style="width:250px;">
						
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
														<?php if($curso['preco']>0):?>
															<h5 align="center">R$<?php echo $curso['preco'] ?></h5>
														<?php else:?>
															<h5 align="center">Gratis</h5>
														<?php endif;?>
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
															<?php if($curso['preco']>0):?>
																<h5 align="center">R$<?php echo $curso['preco'] ?></h5>
															<?php else:?>
																<h5 align="center">Gratis</h5>
															<?php endif;?>
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
				</div>
			<?php endforeach;?>
		</div>
		<div class="row">
			<div class="col">
				<?php foreach($categorias as $categoria):?>
					<div style="overflow-y:auto;height:350px;margin-left:10%;" class="w-100">
						<h1 style="clear:both;margin-top:50px;"><?php echo $categoria['categoria']?></h1>
						<?php foreach($cursos as $curso):?>
							<?php if($categoria['id']==$curso['id_categoria']):?>
								<a href="<?php echo BASE?>principal_curso/entrar_view/<?php echo $curso['id']?>" class="card float-left ml-2 mb-3" style="width:200px;height:250px;background-color:#483D8B;">
									<?php if($categoria['id']==$curso['id_categoria']):?>
										<div class="card-header">
											<h5 align="center"><?php echo $curso['nome']?></h5>
										</div>
									<?php endif;?>

									<?php if($categoria['id']==$curso['id_categoria']):?>
										<img class="card-img-top img-fluid" style="height:125px;" src="<?php echo BASE?>assets/imagens/cursos/<?php echo $curso['imagem']?>">
									<?php endif;?>
									<div class="card-body">
										<?php if($curso['preco']>0):?>
											<h5 align="center">R$<?php echo $curso['preco'] ?></h5>
										<?php else:?>
											<h5 align="center">Gratis</h5>
										<?php endif;?>
									</div>
								</a>
							<?php endif;?>
						<?php endforeach;?>
					</div>
					
				<?php endforeach;?>
			</div>
		</div>
	</div>
</body>
</html>