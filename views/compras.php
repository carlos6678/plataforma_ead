<!DOCTYPE html>
<html lang="pt-br">
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
		<h1 style="clear: both;">Suas Compras</h1>
		<div class="row justify-content-center">
			<table class="table table-dark table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Total da Compra</th>
                        <th>Tipo da compra</th>
                        <th>Status da Compra</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($compras as $compra):?>
                        <tr>
                            <td><?php echo $compra['total_compra']?></td>
                            <td><?php echo $compra['tipo_pagamento']?></td>
                            <td><?php echo $compra['status_pagamento']==1 ? "Aprovado": "pendente"?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
		</div> 
	</div>

</body>
</html>
