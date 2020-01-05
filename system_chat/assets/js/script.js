function chat_abrir(){
    var id = parseInt(document.getElementById('chat_id').value)
    var nome= document.getElementById('nome_chat').value

    chat_ead.setarGrupo(id,nome)

    $('.modal_black').hide()
}
function fechar_modal(){
    $('.modal_black').hide()
}
$(function(){
    if(lista_grupo.length>0){
        for(var x in lista_grupo){
            chat_ead.setarGrupo(lista_grupo[x].id,lista_grupo[x].name)
        }
    }
    chat_ead.chatAtivo()
    chat_ead.usuariosListaAtiva()
    $('.adicionar_tab').click(function(){
        var html="<h1 style='color:white;'>Escolha uma Sala</h1>"

        html+='<div id="lista_grupo">Carregando...</div>'

        html+="<button id='fechar' onclick='fechar_modal()'>Fechar</button>"
        $('.modal_area').html(html)
        $('.modal_black').show()

        chat_ead.carregarListaDeGrupos(function(json){
            var html=""

            for(var x in json.lista_grupo){
                html+="<button id='botao' data-id="+json.lista_grupo[x].id+">"+json.lista_grupo[x].name+"</button>"
            }
            $('#lista_grupo').html(html)
            $('#lista_grupo').find('button').click(function(){
                var id = $(this).attr('data-id')
                var nome = $(this).html()

                chat_ead.setarGrupo(id,nome)
                $('.modal_black').hide()
            })
        })
    })
    $('nav ul').on('click','li .nome_grupo',function(){
        var id = $(this).parent().attr('data-id')

        chat_ead.setActiveGroup(id)
    })
    $('nav ul').on('click','li .sair',function(){
        var id = $(this).parent().attr('data-id')

        chat_ead.removeGrupo(id)
    })
    $('#input_sender').keyup(function(tecla){
        if(tecla.keyCode==13){
            var msg=$(this).val()
            $(this).val('')

            chat_ead.enviarMensagem(msg)
        }
    })
    $('.imgUpload').click(function(){
        $('#imagem').trigger('click')
    })
    $('#imagem').on('change',function(e){
        chat_ead.enviarFoto(e.target.files[0])
    })
})