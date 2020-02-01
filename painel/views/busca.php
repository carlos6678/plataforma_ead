<?php if(!empty($curso)):?>
    <div class="container mt-5">
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
<?php else:?>
    <h1>Você não esse curso criado</h1>
<?php endif;?>