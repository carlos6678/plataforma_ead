<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GV_EAD</title>
</head>
<body id="back-black">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <nav>
                <ul class="pagination">
                    <?php for($page=0;$page<=$total_regs;$page++):?>
                        <li class="page-item"><a style="color:white;" id="dark-blue" class="page-link" href="?pagina=<?php echo $page?>"><?php echo $page+1?></a></li>
                    <?php endfor;?>
                </ul>
            </nav>
        </div>
        
        <table class="table table-striped table-dark">
            <thead>
                <th scope="col">Aluno</th>
                <th scope="col">Cursos Cadastrados</th>
                <th scope="col">Amigos</th>
            </thead>
                <?php foreach($alunos_paginaçao as $cr):?>
                    <?php if($cr['id']!=$_SESSION['aluno']):?>
                        <tr>
                            <th class="d-flex justify-content-between">
                                <div class="media">
                                    <img style="width: 50px;height: 50px;border-radius: 25px;" class="mr-3 avatar" src="<?php echo BASE?>assets/imagens/usuarios/<?php echo $cr['foto_perfil']?>">
                                    <div class="media-body">
                                        <h4><?php echo $cr['nome']?></h4>
                                    </div>
                                </div>
                                <button destinatario="<?php echo $cr['id']?>" class="btn btn-dark dest" style="color:white;" type="button" data-toggle="modal" data-target="#Usuarios">?</button>
                            </th>
                            <th>adsa</th>
                            <td>asdsa</td>
                        </tr>
                    <?php endif;?>
                <?php endforeach;?>
            <tbody>
            </tbody>
        </table>

        <div class="modal" id="Usuarios" tabindex="-1" role="dialog" aria-labelledby="Usuarios" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="back-black">
                        <h5 class="modal-title">Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="back-black">
                        <h4>Ações</h4>
                    </div>
                    <div class="modal-footer" id="dark-blue">
                        <button type="button" class="btn btn-dark startChat" data-dismiss="modal" type="button" data-toggle="modal" data-target="#Chat">Chamar no chat</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Pedir amizade</button>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="modal" id="Chat" tabindex="-1" role="dialog" aria-labelledby="Usuarios" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="back-black">
                        <h5 class="modal-title">Chat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="back-black">
                        <div class="msgs_usuarios">
                            
                        </div>
                    </div>
                    <div class="modal-footer" id="dark-blue">
                        <input type="text" class="w-75 form-control-lg" placeholder="Escreva aqui">
                        <input type="submit" class="btn btn-dark btn-lg" value="Enviar">
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>