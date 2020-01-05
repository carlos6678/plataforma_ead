<h1>Editar o Aluno - <?php echo $aluno['nome']?> </h1>

<fieldset>
	<form method="POST">
		<label>Nome:</label><br>
		<input type="text" name="nome" value="<?php echo $aluno['nome']?>"><br><br>

		<label>E-mail:</label><br>
		<input type="email" name="email" value="<?php echo $aluno['email']?>"><br><br>

		<label>Senha:</label><br>
		<input type="password" name="senha" value="<?php echo $aluno['senha']?>"><br><br>

		<label>Cursos do Aluno:</label><br>
		<label>(Pressione Ctrl para adicionar novos cursos)</label><br>
		<select name="cursos[]" multiple>
			<?php foreach($cursos as $curso):?>
				<option value="<?php echo $curso['id']?>" <?php if(in_array($curso['id'], $inscritos)){
					echo 'selected="selected"';
				}?>> <?php echo utf8_encode($curso['nome'])?> </option>
			<?php endforeach;?>
		</select><br><br>

		<input type="submit" value="Editar dados do usuario">
	</form>
</fieldset>