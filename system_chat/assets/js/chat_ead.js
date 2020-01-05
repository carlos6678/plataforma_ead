var chat_ead={
    groups:[],
    activeGroup:0,
    ultimo_tempo:'',
    RequestMSG:null,
    usuariosRequest:null,
    
    setarGrupo:function(id,nome){
        var found = false

        for(var x in this.groups){
            if(this.groups[x].id==id){
                found=true
            }
        }
        if(found==false){
            this.groups.push({
                id:id,
                nome:nome,
                mensagens:[],
                usuarios:[]
            })
        }
        if(this.groups.length==1){
            this.setActiveGroup(id)
        }
        this.updateGrupoView()

        if(this.RequestMSG!=null){
            this.RequestMSG.abort()
        }
    },

    removeGrupo:function(id){
        for(var x in this.groups){
            if(this.groups[x].id==id){
                this.groups.splice(x,1)
            }
        }
        if(this.activeGroup==id){
            if(this.groups.length>0){
                this.setActiveGroup(this.groups[0].id)
            }else{
                this.activeGroup=0
            }
        }
        this.updateGrupoView()
        if(this.RequestMSG!=null){
            this.RequestMSG.abort()
        }
    },

    getGroups:function(){
        return this.groups
    },

    updateGrupoView:function(){
        var html=''
         for(var x in this.groups){
             html+='<li data-id='+this.groups[x].id+'>'
             html+="<div class='sair'>Sair</div>"
             html+="<div class='nome_grupo'>"+this.groups[x].nome+"</div>"
             html+='</li>'
         }
         $('nav').find('ul').html(html)
         this.loadGrupo()

    },

    carregarListaDeGrupos:function(ajax){
        $.ajax({
            url:BASE+'ajax/getGrupos',
            type:'GET',
            dataType:'json',
            success:function(json){
                if(json.estado=='1'){
                    ajax(json)
                }else{
                    window.location.href="http://localhost/ead/home/"
                }
            }
        })
    },

    setActiveGroup:function(id){
        this.activeGroup=id

        this.loadGrupo()
    },

    getActiveGroup:function(){
        return this.activeGroup
    },

    loadGrupo:function(){
        if(this.activeGroup!=0){
            $('nav ul').find('.active_group').removeClass('active_group')
            $('nav ul').find('li[data-id='+this.activeGroup+']').addClass('active_group')
        }

        //pegar conversa daquele grupo

        this.showMensagens()
        this.showListaUsuarios()
    },

    showListaUsuarios:function(){
        if(this.activeGroup!=0){
            var usuarios=[]
            for(var x in this.groups){
                if(this.groups[x].id==this.activeGroup){
                    usuarios=this.groups[x].usuarios
                }
            }
            var html=''
            for(var x in usuarios){
                html+='<li>'+usuarios[x]+'</li>'
            }
            $('.lista_usuarios').find('ul').html(html)
        }else{
            $('.lista_usuarios').find('ul').html('')
        }
    },

    showMensagens:function(){

        $('.messages').html('')
        if(this.activeGroup!=0){
            var msgs=[]
            for(var x in this.groups){
                if(this.groups[x].id==this.activeGroup){
                    msgs=this.groups[x].mensagens
               }
            }
            for(var x in msgs){
                var html="<div class='message'>"
                html+="<div class='c_info'>"
                html+="<span class='c_sender'>"+msgs[x].name_sender+"</span>"
                html+="<span class='c_date'>"+msgs[x].date_sender+"</span>"
                html+="</div>"
                html+="<div class='c_body'>"
                if(msgs[x].msg_type=='text'){
                    html+=msgs[x].msg
                }else if(msgs[x].msg_type=='img'){
                    html+='<img src="'+BASE+'media/imagens/'+msgs[x].msg+'"/>'
                }
                html+="</div>"
                html+="</div>"
                $('.messages').append(html)
            }
        }
    },

    enviarMensagem:function(msg){

        if(msg.length>0){
            if(this.activeGroup!=0){
                $.ajax({
                    url:BASE+'ajax/adicionar_mensagem',
                    type:'POST',
                    data:{msg:msg,id_grupo:this.activeGroup},
                    dataType:'json',
                    success:function(json){
                        if(json.estado=='1'){
                            if(json.error=='1'){
                                alert(json.errorMSG)
                            }
                        }else{
                            window.location.href=BASE_PRINCIPAL+'home'
                        }
                    }
                })
            }
        }
    },

    enviarFoto:function(foto){
        if(this.activeGroup!=0){
            var formData=new FormData()
            formData.append('foto',foto)
            formData.append('id_grupo',this.activeGroup)

            $.ajax({
                url:BASE+'ajax/adicionar_foto',
                type:'POST',
                dataType:'json',
                data:formData,
                contentType:false,
                processData:false,

                success:function(json){
                    if(json.estado=='1'){
                        if(json.error==1){
                            alert(json.errorMSG)
                        }
                    }else{
                        window.location.href=BASE_PRINCIPAL+'home'
                    }
                },

                xhr:function(){
                    var xhr_padrao=$.ajaxSettings.xhr()
                    if(xhr_padrao.upload){
                        xhr_padrao.upload.addEventListener('progress',function(e){
                            var total=e.total
                            var carregado=e.loaded
                            var porcentagem_carregado=(total/carregado)*100

                            if(porcentagem_carregado>0){
                                $('.progress').show()
                                $('.progresso_barra').css('width',porcentagem_carregado+'%')
                            }
                            
                            if(porcentagem_carregado>=100){
                                $('#progresso_barra').css('width','0%')
                                $('.progress').hide()
                            }
                        },false)
                    }
                    return xhr_padrao
                }

            })
        }

    },

    updateUltimoTempo:function(ultimo_tempo){
        this.ultimo_tempo=this.ultimo_tempo
    },

    inserirMensagem:function(mensagem){
        for(var x in this.groups){
            if(this.groups[x].id==mensagem.id_grupo){
                var msg_date=mensagem.date_mensagem.split(' ')
                msg_date=msg_date[1]
                this.groups[x].mensagens.push(
                    {
                        id:mensagem.id,
                        id_sender:mensagem.id_usuario,
                        name_sender:mensagem.nomes,
                        date_sender:msg_date,
                        msg:mensagem.mensagem,
                        msg_type:mensagem.msg_type
                    }
                )
            }
        }
    },

    chatAtivo:function(){
        var grupos=this.getGroups()
        var grupos_id=[]

        for(var x in grupos){
            grupos_id.push(grupos[x].id)
        }
        if(grupos_id.length>0){
            this.RequestMSG=$.ajax({
                url:BASE+'ajax/get_mensagens',
                type:'GET',
                data:{ultimo_tempo:this.ultimo_tempo,grupos:grupos_id},
                dataType:'json',
                success:function(json){
                    if(json.estado=='1'){
                        chat_ead.updateUltimoTempo(json.ultimo_tempo)
                        for(var x in json.msgs){
                            chat_ead.inserirMensagem(json.msgs[x])
                        }
                        chat_ead.showMensagens()
                    }else{
                        window.location.href=BASE_PRINCIPAL+'home'
                    }
                },
                complete:function(){
                    chat_ead.chatAtivo()
                }
            })
        }else{
            setTimeout(function(){chat_ead.chatAtivo()},1000)
        } 
    },
    updateUsuariosLista:function(usuarios,id_grupo){
        for(var x in this.groups){
            if(this.groups[x].id==id_grupo){
                this.groups[x].usuarios=usuarios
            }
        }
    },
    usuariosListaAtiva:function(){
        var grupos=this.getGroups()
        var grupos_id=[]

        for(var x in grupos){
            grupos_id.push(grupos[x].id)
        }

        if(grupos.length>0){
            this.usuariosRequest=$.ajax({
                url:BASE+'ajax/get_ListaUsuarios',
                type:'GET',
                data:{grupos:grupos_id},
                dataType:'json',
                success:function(json){
                    if(json.estado=='1'){
                        for(var x in json.usuarios){
                            chat_ead.updateUsuariosLista(json.usuarios[x],x)
                        }
                        chat_ead.showListaUsuarios()
                    }else{
                        window.location.href=BASE_PRINCIPAL+'home'
                    } 
                },
                complete:function(){
                    setTimeout(function(){chat_ead.usuariosListaAtiva()},5000)
                }
            })
        }else{
            setTimeout(function(){chat_ead.usuariosListaAtiva()},1000)
        }
    }
}