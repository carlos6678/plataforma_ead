<h1>Editar Modulo - <?php echo utf8_encode($modulo['nome'])?></h1>

<fieldset>
	<form method="POST">
		<label>Nome Do Modulo</label><br>
		<input type="text" name="nome" value="<?php echo utf8_encode($modulo['nome'])?>"> <input type="submit" value="Salvar">
	</form>
</fieldset>