<div class="container">
    <div class="usuario_info">
        <strong>User:</strong><strong><?php echo $info_usuario->getNome()?></strong> - <div class="btn"><a href="<?php echo BASE?>home/sair">Sair do chat</a></div>
    </div>
    <nav> 
        <ul>
            
        </ul>
        <button class="adicionar_tab"><ion-icon name="person-add" style="font-size:25px;"></ion-icon></button>
    </nav>


    <section>
        <div class="messages"></div>
        <div class="lista_usuarios">
            <ul>
               
            </ul>
        </div>
    </section> 

    <footer>
        <div class="area_sender">
            <input type="file" id="imagem">
            <input type="text" id="input_sender" placeholder="Digite Uma mensagem aqui">
            <div class="ferramentas">
                <div class="ferramenta_sender imgUpload" >
                    <ion-icon name="camera" style="font-size:25px"></ion-icon>
                </div>
                <div class="ferramenta_sender"></div> 
            </div>
        </div>
        <div class="progress">
            <div class="progresso_barra" ></div>
        </div>
    </footer>

</div> 