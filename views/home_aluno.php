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
			<?php if(empty($info->getFoto())):?>
				<img class="w-25" src="<?php echo BASE?>assets/imagens/home.png">
			<?php else:?>
				<img style="height:300px;width:300px;border-radius:150px;" src="<?php echo BASE?>assets/imagens/usuarios/<?php echo $info->getFoto()?>">
			<?php endif;?>
		</div> 
		<h1 style="clear: both;">Cursos que Você esta cadastrado</h1>
		<div class="row">
			<?php foreach($cursos_cadastrados as $cursos):?>
			<a class="card ml-3 mb-3 " style="width:300px;height:300px;" id="dark-blue" href="<?php echo BASE;?>cursos/entrar/<?php echo $cursos['id']?>">
			
				<img class="w-100 img-card-top"  src="<?php echo BASE;?>/assets/imagens/cursos/<?php echo $cursos['imagem']?>" border="0" style="height:300px;"><br><br>

				<div class="card-body">
					<h5 align="center"><?php echo utf8_encode($cursos['nome']);?></h5>
				</div>
		
			</a>
		</div>
		<?php endforeach;?>	
	</div>

</body>
</html>
