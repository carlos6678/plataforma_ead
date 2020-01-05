<h1>Editar Questionario - <?php echo utf8_encode($aula['pergunta'])?></h1>

<fieldset>
	<form method="POST">
		<label>Pergunta:</label><br>
		<input type="text" name="pergunta" value="<?php  echo utf8_encode($aula['pergunta'])?>"><br><br>

		<label>Opção1</label><br>
		<input type="text" name="opcao1" value="<?php echo $aula['opcao1']?>"><br><br>

		<label>Opção2</label><br>
		<input type="text" name="opcao2" value="<?php echo $aula['opcao2']?>"><br><br>

		<label>Opção3</label><br>
		<input type="text" name="opcao3" value="<?php echo $aula['opcao3']?>"><br><br>

		<label>Opção4</label><br>
		<input type="text" name="opcao4" value="<?php echo $aula['opcao4']?>"><br><br>

		<label>Resposta:</label>
		<select name="resposta">
			<option value="1" <?php echo ($aula['resposta']=='1')?'selected="selected"':'';?> >Opção 1</option>
			<option value="2" <?php echo ($aula['resposta']=='2')?'selected="selected"':'';?>>Opção 2</option>
			<option value="3" <?php echo ($aula['resposta']=='3')?'selected="selected"':'';?>>Opção 3</option>
			<option value="4" <?php echo ($aula['resposta']=='4')?'selected="selected"':'';?>>Opção 4</option>
		</select>
		<input type="submit" value="Salvar">
	</form>
</fieldset>