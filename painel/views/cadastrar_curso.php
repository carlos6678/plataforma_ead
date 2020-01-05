<h1>Cadastre seu Curso aqui:</h1>

<form method="POST" enctype="multipart/form-data">
	<label>Nome do Curso:</label><br>
	<input type="text" name="nome" required><br><br>

	<label>Descrição:</label><br>
	<textarea name="descricao" required></textarea><br><br>

	<label>Imagem do Curso</label><br>
	<input type="file" name="imagem" required><br><br>

	<label>Categoria</label>
	<select name="categoria">
		<option value="1">Exatas</option>
		<option value="2">Humanas</option>
		<option value="3">Biologicas</option>
	</select>

	<input type="submit" value="Criar">

</form>