<div class="container mt-5">
	<h1>Cursos Que Você Criou:</h1>
	<button class="btn btn-lg mb-5" data-toggle="modal" type="button" id="dark-blue" data-target="#criar_curso" style="color:white;" href="<?php BASE?>home/adicionar">Adicionar Curso</button>

	<button class="btn btn-lg mb-5" data-toggle="modal" type="button" id="dark-blue" data-target="#grafico" style="color:white;">Grafico</button>

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
					<form id="form_add_curso">
						<label>Nome do Curso:</label><br>
						<input class="form-control" type="text" name="nome" required><br><br>

						<label>Descrição:</label><br>
						<textarea class="form-control" name="descricao" required></textarea><br><br>
 
						<label>Imagem do Curso</label><br>
						<input id="img_curso" type="file" name="imagem" required><br><br>
						<img src="" id="imagem_curso" class="w-100"><br><br>

						<label>Categoria</label><br>
						<select id="categoria_name" class="form-control" name="categoria">
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
				<?php array_unshift($cursos_graf,$curso['nome'])?>
				<?php array_unshift($cursos_qt,$curso['qtAlunos'])?>
			</div>
			<img class="card-img-top w-100" height="500px" src="<?php echo BASE?>../assets/imagens/cursos/<?php echo $curso['imagem'];?>" border="0">
			<div class="card-body d-sm-inline-flex" id="dark-blue">
				<a href="<?php BASE?>home/editar/<?php echo $curso['id']?>">
				<img class=" w-50 img-fluid"  data-toggle="tooltip" title="Editar Curso" src="<?php echo BASE?>assets/imagens/editar.png">
				</a>
				<div class="w-50 d-flex align-self-center">
					<h1 class="w-100" style="font-size:60px;word-wrap:break-word"><?php echo utf8_encode($curso['nome'])?></h1>
				</div>
			</div>
		</div> 
	<?php endforeach;?>
	<div class="modal fade" aria-hidden="true" id="grafico">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header" id="dark-blue">
					<h1 class="modal-title">Grafico</h1>
					<button class="close" type="button" aria-label="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="back-black">	
					<canvas id="grafico_curso">
						<script type="text/javascript">
							var nomes ='<?php echo implode(',',$cursos_graf)?>'
							var nomes= nomes.split(',')
							var array_nome=nomes.map(s=>{
								return ""+s+""
							})
							var cont=document.getElementById('grafico_curso').getContext("2d")
							var grafico=new Chart(cont,{
								type:'bar',
								data:{
									labels:array_nome,
									datasets:[{
										label:'Quantidade de alunos',
										backgroundColor:'#483D8B',
										borderColor:'#483D8B',
										data:[<?php echo implode(',',$cursos_qt)?>],
										fill:false
									}]
								}
							})
						</script>
					</canvas>
				</div>
			</div>
		</div>
	</div>
</div>