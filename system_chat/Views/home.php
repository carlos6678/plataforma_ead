<div class="container">
    <div class="usuario_info">
        Usuario logado nesse momento:<strong><?php echo $info_usuario->getNome()?></strong> - <a href="<?php echo BASE_PRINCIPAL?>">Sair do chat</a>
    </div>
    <nav> 
        <ul>
            
        </ul>
        <button class="adicionar_tab">++</button>
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
                <div class="ferramenta_sender imgUpload"></div>
                <div class="ferramenta_sender"></div> 
            </div>
        </div>
        <div class="progress">
            <div class="progresso_barra" ></div>
        </div>
    </footer>

</div> 