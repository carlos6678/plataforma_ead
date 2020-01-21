<div class="container">
	<h1>Cursos Que Você Criou:</h1>
	<button class="btn btn-lg mb-5" data-toggle="modal" type="button" id="dark-blue" data-target="#criar_curso" style="color:white;" href="<?php BASE?>home/adicionar">Adicionar Novo Curso</button>

	<div class="modal fade" aria-hidden="true" id="criar_curso">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header" id="dark-blue">
					<h1 class="modal-title">Criar Curso</h1>
					<button class="close" type="button" arial-label="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="back-black">
					<form>
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

						<input class="btn btn-lg w-100" id="dark-blue" type="submit" value="Criar">
					</form>
				</div>
			</div>
		</div>
	</div>
 
	<?php foreach($cursos as $curso):?>
		<div class="card w-100 mb-5" style="border:none;">
			<div class="card-header" id="dark-blue">
				<h3>Alunos:<?php echo utf8_encode($curso['qtAlunos'])?></h3>
			</div>
			<img class="card-img-top w-100" height="400px" src="<?php echo BASE?>../assets/imagens/cursos/<?php echo $curso['imagem'];?>" border="0">
			<div class="card-body d-sm-inline-flex" id="dark-blue">
				<a href="<?php BASE?>home/editar/<?php echo $curso['id']?>">
				<img class=" w-50 img-fluid" data-toggle="tooltip" title="Editar Curso" src="<?php echo BASE?>assets/imagens/editar.png">
				</a>
				<div class="w-50 d-flex align-self-center">
					<h1 class="w-100" style="font-size:60px;word-wrap:break-word"><?php echo utf8_encode($curso['nome'])?></h1>
				</div>
			</div>
		</div> 
	<?php endforeach;?>
</div>
