<h1>Cursos Que Você Criou:</h1>
<a href="<?php BASE?>home/adicionar">Adicionar Curso</a>

<table border="1" width="100%">
	<tr>
		<th>Imagem</th>
		<th>Nome</th>
		<th>Quant.alunos</th>
		<th>Ações</th>
	</tr>  
	<?php foreach($cursos as $curso):?>
	<tr>
		<td align="center"> <img src="<?php echo BASE?>../assets/imagens/cursos/<?php echo $curso['imagem'];?>" border="0" height="80" width="150"> </td>
		<td align="center"><?php echo utf8_encode($curso['nome'])?></td>
		<td align="center"><?php echo utf8_encode($curso['qtAlunos'])?></td>
		<td align="center">
			<a href="<?php BASE?>home/editar/<?php echo $curso['id']?>">Editar Curso</a> - 
			<?php if($_SESSION['admin']==ROOT):?> 
				<a href="<?php BASE?>home/deletar/<?php echo $curso['id']?>">Deletar Curso</a>
			<?php endif;?>
		</td>
	</tr>
	<?php endforeach;?>
</table>