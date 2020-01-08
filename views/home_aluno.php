<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body id="back-black">
	<div class="container-fluid mt-3">
		<div class="row justify-content-center" id="dark-blue">
			<img class="w-25" src="<?php echo BASE?>assets/imagens/home.png">
		</div>
		<h1 style="clear: both;">Cursos que Você esta cadastrado</h1>
		<div class="row justify-content-center">
			<?php foreach($cursos_cadastrados as $cursos):?>
			<a class="card ml-3 mb-3 w-50" id="dark-blue" href="<?php echo BASE;?>cursos/entrar/<?php echo $cursos['id']?>">
			
				<img class="w-100 img-card-top" src="<?php echo BASE;?>/assets/imagens/cursos/<?php echo $cursos['imagem']?>" border="0" style="width:200px;height:200px;"><br><br>

				<div class="card-body">
					<h5 align="center"><?php echo utf8_encode($cursos['nome']);?></h5>
				</div>
		
			</a>
			<?php endforeach;?>	
		</div> 
	</div>

</body>
</html>
