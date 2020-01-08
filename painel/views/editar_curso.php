<div class="container-fluid">
	<h1>Ferramentas</h1>
	<div class="row">
		<div class="col-2">
			<img id="edit1" data-toggle="tooltip" title="Conteudo do Seu curso" style="cursor:pointer;" class="w-100 mb-3" src="<?php echo BASE?>assets/imagens/conteudo.png">
			<img id="edit2" data-toggle="tooltip" title="Adicionar Modulo" style="cursor:pointer;" class="w-100 mb-3" src="<?php echo BASE?>assets/imagens/editar_modulo.png">
			<img id="edit3" data-toggle="tooltip" title="Adicionar Aula" style="cursor:pointer;" class="w-100 mb-3" src="<?php echo BASE?>assets/imagens/editar_aula.png">
			<img id="edit4" data-toggle="tooltip" title="Editar curso" style="cursor:pointer;" class="w-100 mb-3" src="<?php echo BASE?>assets/imagens/editar_curso.png">
		</div>
		<div class="col-10">
			<div id="editar_curso" style="display:none;">
				<form method="POST" enctype="multipart/form-data" class="form-group">
					<label>Nome do Curso:</label><br>
					<input class="form-control" type="text" name="nome" value="<?php echo utf8_encode($curso['nome'])?>"><br"><br>

					<label>Descrição:</label><br>
					<textarea class="form-control" name="descricao" value="<?php echo $curso['descricao']?>"><?php echo $curso['descricao']?></textarea><br><br>

					<label>Imagem do Curso</label><br>
					<input type="file" name="imagem" class="form-control-file"><br><br>
					<img  class="img-fluid" src="<?php echo BASE;?>../assets/imagens/cursos/<?php echo $curso['imagem']?>" border="0" height="80"><br><br>

					<input class="form-control" type="submit" value="Salvar">
				</form>
			</div>

			<div id="editar_curso" style="display:none;">
				<h2>adicionar Modulo</h2>
				<fieldset>
					<form method="POST">
						<label>Nome Do Modulo</label><br>
						<input type="text" name="Modulo" class="form-control" placeholder="ex:BASICO"> <input type="submit" value="Adicionar Novo Módulo" class="form-control">
					</form>
				</fieldset>
			</div>

			<div id="editar_curso" style="display:none;">
				<fieldset>
					<h2>Adicionar nova Aula</h2>
					<form method="POST">
						<label>Nome da aula:</label><br><br>
						<input class="form-control" type="text" name="Aula"><br><br>
						<label>Qual modulo pertencerá a aula</label><br><br>
						<select class="form-control" name="ModuloAula">
							<?php foreach($modulos as $modulo):?>
								<option class="form-control" value="<?php echo utf8_encode($modulo['id'])?>"><?php echo utf8_encode($modulo['nome'])?></option>
							<?php endforeach;?>
						</select><br><br>

						<label>Tipo da aula:</label><br><br>
						<select class="form-control" name="tipo">
							<option class="form-control" value="video">Video</option>
							<option class="form-control" value="poll">Questionário</option>
						</select><br><br>
						<input class="form-control" type="submit" value="Adicionar nova aula">
					</form>
				</fieldset>
			</div>
			 
			<div id="editar_curso" style="display:none;">
				<div id="accordion">
					<div class="card" id="back-black">
						<div class="card-header" style="background-color:black;">
							<button align="center" class="btn btn-lg w-100" data-toggle="collapse" data-target="#area" aria-controls="area" style="color:white;">Modulos</button>
						</div> 
						<div id="area" class="collapse" data-parent="#accordion">
							<div class="card-body">
								<div class="card" style="background-color:#1C1C1C;">
									<?php foreach($modulos as $modulo):?>
										<div class="card-header">
											<button style="color:white;" class="btn w-100" data-toggle="collapse" data-target="#area<?php echo $modulo['id']?>"><?php echo utf8_encode($modulo['nome'])?></button>

											<a class="btn btn-dark" href="<?php echo BASE?>home/editarModulo/<?php echo $modulo['id']?>">Editar</a>

											<a class="btn  btn-dark" href="<?php echo BASE?>home/deletarModulo/<?php echo $modulo['id']?>">Excluir</a>
										</div>
										
										<div id="area<?php echo $modulo['id']?>" class="collapse">
											<?php foreach($modulo['aulas'] as $aula):?>
												<?php if($modulo['id']===$aula['id_modulo']):?>
													<div class="card-body" id="dark-blue" style="color:white;">
														<?php echo utf8_decode($aula['nome'])?>

														<a class="btn btn-dark" href="<?php echo BASE?>home/editarAula/<?php echo $aula['id']?>">Editar</a>

														<a class="btn btn-dark" href="<?php echo BASE?>home/deletarAula/<?php echo $aula['id']?>">Excluir</a></h5>
													</div>
												<?php endif;?>
											<?php endforeach;?>
										</div>
									<?php endforeach;?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>

