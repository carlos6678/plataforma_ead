<h1>Editar aula - <?php echo utf8_encode($aula['nome'])?></h1>

<fieldset>
	<form method="POST">
		<label>Nome Da Aula</label><br>
		<input type="text" name="nome" value="<?php  echo utf8_encode($aula['nome'])?>"><br><br>
		<label>Descrição da aula</label><br>
		<textarea name="descricao_aula" value="<?php  echo utf8_encode($aula['descricao'])?>"></textarea><br><br>
		<label>Codigo do Vimeo</label><br>
		<input type="text" name="url" value="<?php echo $aula['url']?>">
		<input type="submit" value="Salvar">
	</form>
</fieldset>