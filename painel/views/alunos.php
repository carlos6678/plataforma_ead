<h1>Alunos</h1>
<?php if($_SESSION['admin']==1):?>
	<a href="<?php BASE?>alunos/adicionar">Adicionar Aluno</a>
<?php endif;?>
<table border="1" width="100%">
	<tr>
		<th>Nome do Aluno</th>
		<th>Quant.Cursos</th>
		<th>Ações</th>
	</tr>
	<?php foreach($alunos as $aluno):?>
	<tr>
		<td align="center"><?php echo utf8_encode($aluno['nome'])?></td>
		<td align="center"><?php echo utf8_encode($aluno['qtCursos'])?></td>
		<?php if($_SESSION['admin']==1):?>
			<td align="center">
				<a href="<?php BASE?>alunos/editar/<?php echo $aluno['id']?>">Editar Curso</a> - 
				<a href="<?php BASE?>alunos/deletar/<?php echo $aluno['id']?>">Deletar Curso</a>
			</td>
		<?php endif;?>
	</tr>
	<?php endforeach;?>
</table>