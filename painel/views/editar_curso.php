<div class="container">
	<h1>Edite esse Curso</h1>

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

	<hr>

	<h2>Aulas</h2>

	<fieldset>
		<legend>Adicionar um Modulo novo</legend>
		<form method="POST">
			<label>Nome Do Modulo</label><br>
			<input type="text" name="Modulo"> <input type="submit" value="Adicionar Novo Módulo">
		</form>
	</fieldset><br>

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
	</fieldset><br>

	<?php foreach($modulos as $modulo):?>
		<h4><?php echo utf8_encode($modulo['nome'])?> - <a href="<?php echo BASE?>home/editarModulo/<?php echo $modulo['id']?>">[Editar]</a> - <a href="<?php echo BASE?>home/deletarModulo/<?php echo $modulo['id']?>">[Excluir]</a></h4>

		<?php foreach($modulo['aulas'] as $aula):?>
			<h5><?php echo $aula['nome']?> - <a href="<?php echo BASE?>home/editarAula/<?php echo $aula['id']?>">[Editar]</a> - <a href="<?php echo BASE?>home/deletarAula/<?php echo $aula['id']?>">[Excluir]</a></h5>
		<?php endforeach;?>
	<?php endforeach;?>
</div>
