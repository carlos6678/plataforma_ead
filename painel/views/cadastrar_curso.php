<h1>Cadastre seu Curso aqui:</h1>

<form method="POST" class="form-group" enctype="multipart/form-data">
	<label>Nome do Curso:</label><br>
	<input class="form-control" type="text" name="nome" required><br><br>

	<label>Descrição:</label><br>
	<textarea class="form-control" name="descricao" required></textarea><br><br>

	<label>Imagem do Curso</label><br>
	<input type="file" name="imagem" required><br><br>

	<label>Categoria</label><br>
	<select class="form-control" name="categoria">
		<option class="form-control" value="1">Exatas</option>
		<option class="form-control" value="2">Humanas</option>
		<option class="form-control" value="3">Biologicas</option>
	</select><br><br>
	<label for="gratis">Gratis</label>
	<input type="checkbox" value="0" id="gratis" name="gratis"><br><br>
	<label for="cobrar">Ou digite um valor que deseja cobrar</label><br>
	<input class="form-control mb-3" type="text" name="valor" id="cobrar">

	<input class="form-control" type="submit" value="Criar">

</form>