<div class="container-fluid">
	<h1>Ferramentas</h1>
	<div class="row">
		<div class="col-2 ferramentas">
			<img id="edit1" data-toggle="tooltip" title="Editar curso" style="cursor:pointer;" class="w-100 mb-3" src="<?php echo BASE?>assets/imagens/editar_curso.png">
			<img id="edit2" data-toggle="tooltip" title="Adicionar Modulo" style="cursor:pointer;" class="w-100 mb-3" src="<?php echo BASE?>assets/imagens/editar_modulo.png">
			<img id="edit3" data-toggle="tooltip" title="Adicionar Aula" style="cursor:pointer;" class="w-100 mb-3" src="<?php echo BASE?>assets/imagens/editar_aula.png">
			<img id="edit4" data-toggle="tooltip" title="Conteudo do Seu curso" style="cursor:pointer;" class="w-100" src="<?php echo BASE?>assets/imagens/conteudo.png">
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
					<legend>Adicionar um Modulo novo</legend>
					<form method="POST">
						<label>Nome Do Modulo</label><br>
						<input type="text" name="Modulo" class="form-control"> <input type="submit" value="Adicionar Novo Módulo" class="form-control">
					</form>
				</fieldset>
			</div>

			<div id="editar_curso" style="display:none;">
				<fieldset>
					<legend>Adicionar nova Aula</legend>
					<form method="POST">
						<label>Nome da aula:</label><br><br>
						<input type="text" name="Aula"><br><br>
						<label>Qual modulo pertencera a aula</label><br><br>
						<select name="ModuloAula">
							<?php foreach($modulos as $modulo):?>
								<option value="<?php echo utf8_encode($modulo['id'])?>"><?php echo utf8_encode($modulo['nome'])?></option>
							<?php endforeach;?>
						</select><br><br>

						<label>Tipo da aula:</label><br><br>
						<select name="tipo">
							<option value="video">Video</option>
							<option value="poll">Questionário</option>
						</select><br><br>
						<input type="submit" value="Adicionar nova aula">
					</form>
				</fieldset>
			</div>
			
			<div id="editar_curso" style="display:none;">
				<?php foreach($modulos as $modulo):?>
					<h4><?php echo utf8_encode($modulo['nome'])?> - <a href="<?php echo BASE?>home/editarModulo/<?php echo $modulo['id']?>">[Editar]</a> - <a href="<?php echo BASE?>home/deletarModulo/<?php echo $modulo['id']?>">[Excluir]</a></h4>

					<?php foreach($modulo['aulas'] as $aula):?>
						<h5><?php echo $aula['nome']?> - <a href="<?php echo BASE?>home/editarAula/<?php echo $aula['id']?>">[Editar]</a> - <a href="<?php echo BASE?>home/deletarAula/<?php echo $aula['id']?>">[Excluir]</a></h5>
					<?php endforeach;?>
				<?php endforeach;?>
			</div>
		</div>
	</div>
	
</div>
