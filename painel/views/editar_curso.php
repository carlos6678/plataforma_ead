<div class="container-fluid">
	<div class="row justify-content-center mt-3 mb-3">
		<div class="dropdown">
			<button class="btn btn-lg" id="dropf" type="button" aria-expanded="false" data-toggle="dropdown">
				<h1>Ferramentas</h1>
			</button>
			<div class="dropdown-menu" id="back-black" aria-labelledby="dropf">
				<button id="dark-blue" class="btn btn-lg w-100 mb-1" type="button" data-toggle="modal" data-target="#editar_curso" style="border:none">Editar Curso</button>
				<button id="dark-blue" class="btn btn-lg w-100 mb-1" type="button" data-toggle="modal" data-target="#adicionar_modulo" style="border:none">Modulo Novo</button>
				<button id="dark-blue" class="btn btn-lg w-100" type="button" data-toggle="modal" data-target="#adicionar_aula" style="border:none">Adicionar Aula</button>
			</div>
		</div>
	</div>
	<div class="row">
		
		<div class="col-12">
			<div class="edicao">
				<div id="accordion">
					<div class="card" id="back-black">
						<div class="card-header" style="background-color:black;">
							<button align="center" class="btn btn-lg w-100" data-toggle="collapse" data-target="#area" aria-controls="area" style="color:white;font-size:25px">Modulos</button>
						</div> 
						<div id="area" class="collapse" data-parent="#accordion">
							<div class="card-body">
								<div class="card" style="background-color:#1C1C1C;">
									<?php foreach($modulos as $modulo):?>
										<div class="card-header">
											<button id="conteudo_curso" style="color:white;" class="btn w-100" data-toggle="collapse" data-target="#area<?php echo $modulo['id']?>">
											<p><?php echo utf8_encode($modulo['nome'])?></p>
											</button>

											<button class="btn btn-dark editM" data-toggle="modal" type="button" data-target="#editar_modulo" id_modulo="<?php echo $modulo['id']?>">Editar</button>

											<button onclick="alert('Esse modulo sera apagado)" class="btn  btn-dark removeM" id_modulo="<?php echo $modulo['id']?>">Excluir</button>
										</div>
										
										<div id="area<?php echo $modulo['id']?>" class="collapse">
											<?php foreach($modulo['aulas'] as $aula):?>
												<?php if($modulo['id']===$aula['id_modulo']):?>
													<div class="card-body" id="dark-blue" style="color:white;">
														<?php echo utf8_decode($aula['nome'])?>

														<button class="btn btn-dark editA" id_aula="<?php echo $aula['id']?>">Editar</button>

														<button id_aula="<?php echo $aula['id']?>" class="btn btn-dark removeA">Excluir</button>
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
			<div class="modais">
				<div class="modal fade" aria-hidden="true" id="editar_modulo">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header" id="dark-blue">
								<h1 class="modal-title">Editar Modulo</h1>
								<button type="button" class="close" data-dismiss="modal" arial-label="close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body" id="back-black">
								<form method="POST" class="form-inline" id="form-modulo">
									<input class="form-control w-50" type="text" name="nome" placeholder="Nome do modulo">
									<input class="btn" id="dark-blue" type="submit" value="Salvar">
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade" aria-hidden="true" id="Video">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header" id="dark-blue">
								<h1 class="modal-title">Editar Aula - Video</h1>
								<button type="button" class="close" data-dismiss="modal" arial-label="close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body" id="back-black">
								<form id="form_aula">
									<label>Nome Da Aula</label><br>
									<input class="form-control" type="text" name="nome"><br><br>
									<label>Descrição da aula</label><br>
									<textarea class="form-control" name="descricao_aula"></textarea><br><br>
									<label>Codigo do Vimeo</label><br>
									<input class="form-control" type="text" name="url">
									<input class="btn btn-lg w-100" id="dark-blue" type="submit" value="Salvar">
								</form>
							</div>
						</div>
					</div>
				</div>
					<div class="modal fade" aria-hidden="true" id="Questionario">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header" id="dark-blue">
									<h1 class="modal-title">Editar Aula - Questionário</h1>
									<button type="button" class="close" data-dismiss="modal" arial-label="close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" id="back-black">
									<form id="form_quest">
										<label>Pergunta:</label><br>
										<input class="form-control" type="text" name="pergunta"><br><br>

										<label>Opção1</label><br>
										<input class="form-control" type="text" name="opcao1"><br><br>

										<label>Opção2</label><br>
										<input class="form-control"type="text" name="opcao2" ><br><br>

										<label>Opção3</label><br>
										<input class="form-control" type="text" name="opcao3"><br><br>

										<label>Opção4</label><br>
										<input class="form-control" type="text" name="opcao4"><br><br>

										<label>Resposta:</label>
										<select class="form-control" name="resposta">
											<option value="1">Opção 1</option>
											<option value="2">Opção 2</option>
											<option value="3">Opção 3</option>
											<option value="4">Opção 4</option>
										</select>
										<input class="btn w-100" id="dark-blue" type="submit" value="Salvar">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="modal fade" aria-hidden="true" id="editar_curso">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header" id="dark-blue">
								<h1 class="modal-title">Editar Curso</h1>
								<button type="button" data-dismiss="modal" aria-label="close" class="close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body" id="back-black">
								<form id="form_curso">
									<label>Nome do Curso:</label><br>
									<input class="form-control" type="text" name="nome" value="<?php echo utf8_encode($curso['nome'])?>"><br"><br>
				
									<label>Descrição:</label><br>
									<textarea class="form-control" name="descricao" value="<?php echo $curso['descricao']?>"><?php echo $curso['descricao']?></textarea><br><br>
				
									<label>Imagem do Curso</label><br>
									<input id="foto" type="file" name="imagem" class="form-control-file"><br><br>
									<img  id="imagem" class="img-fluid" src="<?php echo BASE;?>../assets/imagens/cursos/<?php echo $curso['imagem']?>" border="0" height="80"><br><br>
				
									<input class="btn w-100" id="dark-blue" type="submit" value="Salvar">
								</form>
							</div>
						</div>
					</div>
				</div>
	
				<div class="modal fade" aria-hidden="true" id="adicionar_modulo">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header" id="dark-blue">
								<h1 class="modal-title">Adicionar Modulo</h1>
								<button type="button" data-dismiss="modal" aria-label="close" class="close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body" id="back-black">
								<form id="form_modulo">
									<label>Nome Do Modulo</label><br>
									<input type="text" name="Modulo" class="form-control" placeholder="ex:BASICO"> <input type="submit" value="Adicionar Novo Módulo" class="btn w-100" id="dark-blue">
								</form>
							</div>
						</div>
					</div>
				</div>
	
				<div class="modal fade" aria-hidden="true" id="adicionar_aula">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header" id="dark-blue">
								<h1 class="modal-title">Adicionar Aula</h1>
								<button type="button" data-dismiss="modal" aria-label="close" class="close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body" id="back-black">
								<form id="form_aula_add">
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
									<input class="btn w-100" id="dark-blue" type="submit" value="Adicionar nova aula">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>