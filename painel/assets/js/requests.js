state={
    id_modulo:0,
    id_aula:0,
    aula_tipo:'',
    foto:null
}
$(function(){
    $('.editM').on('click',function(){
        state.id_modulo=$(this).attr('id_modulo')
    })
    $('.editA').on('click',function(){
        state.id_aula=$(this).attr('id_aula')
        $.ajax({
            url:BASE+'ajax/VerificarAula/'+state.id_aula,
            dataType:'json',
            type:'GET',
            success:function(json){
                state.aula_tipo=json.aula_tipo
                state.info_aula=json
                if(state.aula_tipo=='Video'){
                    $('#Video').modal('show')
                    var form_aula=$('#form_aula')[0]
                    $(form_aula[0]).attr('value',json.aula.nome)
                    $(form_aula[1]).attr('value',json.aula.descricao)
                    $(form_aula[2]).attr('value',json.aula.url)
                }else{
                    $('#Questionario').modal('show')
                    var form_aula=$('#form_quest')[0]
                    $(form_aula[0]).attr('value',json.aula.pergunta)
                    $(form_aula[1]).attr('value',json.aula.opcao1)
                    $(form_aula[2]).attr('value',json.aula.opcao2)
                    $(form_aula[3]).attr('value',json.aula.opcao3)
                    $(form_aula[4]).attr('value',json.aula.opcao4)
                }
            },
            error:function(){
                alert('Erro na requisição')
            }
        })

    })
    $('.removeM').on('click',function(){
        state.id_modulo=$(this).attr('id_modulo')
        $.ajax({
            url:BASE+'ajax/RemoverModulo/'+state.id_modulo,
            success:function(){
                window.location.href=window.location.href
            },
            error:function(){
                alert('Erro tente de novo')
            }
        })

    })
    $('.removeA').on('click',function(){
        state.id_aula=$(this).attr('id_aula')
        $.ajax({
            url:BASE+'ajax/RemoverAula/'+state.id_aula,
            success:function(){
                window.location.href=window.location.href
            },
            error:function(){
                alert('Erro tente de novo')
            }
        })

    })
    $('#form-modulo').on('submit',function(e){
        e.preventDefault()
        var form_data=$(this).serialize()
        $.ajax({
            url:BASE+'ajax/EditarModulo/'+state.id_modulo,
            type:'POST',
            data:form_data,
            success:function(){
                window.location.href=window.location.href
            },
            error:function(){
                alert('Erro tente de novo')
            }
        })
    })
    $('#form_aula').on('submit',function(e){
        e.preventDefault()
        var form_data=$(this).serialize()
        $.ajax({
            url:BASE+'ajax/ModificarAulaVideo/'+state.id_aula,
            type:'POST',
            data:form_data,
            success:function(){
                window.location.href=window.location.href
            },
            error:function(){
                alert('Erro na requisição')
            }
        })
    })
    $('#form_quest').on('submit',function(e){
        e.preventDefault()
        var form_data=$(this).serialize()
        $.ajax({
            url:BASE+'ajax/ModificarAulaQuestionario/'+state.id_aula,
            type:'POST',
            data:form_data,
            success:function(){
                window.location.href=window.location.href
            },
            error:function(){
                alert('Erro na requisição')
            }
        })
    })
    $('#foto').on('change',function(e){
        state.foto=e.target.files[0]
        const imgReader=new FileReader()
        imgReader.onloadend=()=>{
            $('#imagem').attr('src',imgReader.result)
        }
        imgReader.readAsDataURL(state.foto)
    })
    $('#form_curso').on('submit',function(e){
        e.preventDefault()
        var form= new FormData()
        form.append('nome',$(this).find('input[type=text]').val())
        form.append('descricao',$(this).find('textarea[name=descricao]').val())
        form.append('imagem',state.foto)
        $.ajax({
             url:BASE+"ajax/EditarCurso/"+ID_CURSO,
             type:'POST',
             data:form,
             success:function(){
                 window.location.href=window.location.href
             },
             error:function(){
                 alert('Erro na requisiçao')
             }
         })
    })
    $('#form_modulo').on('submit',function(e){
        e.preventDefault()
        var form_data=$(this).serialize()

        $.ajax({
            url:BASE+'ajax/AdicionarModulo/'+ID_CURSO,
            type:'POST',
            data:form_data,
            success:function(){
                window.location.href=window.location.href
            },
            error:function(){
                alert('Erro na requisiçao')
            }
        })
    })
    $('#form_aula_add').on('submit',function(e){
        e.preventDefault()
        var form_data=$(this).serialize()

        $.ajax({
            url:BASE+'ajax/AdicionarAula/'+ID_CURSO,
            type:'POST',
            data:form_data,
            success:function(){
                window.location.href=window.location.href
            },
            error:function(){
                alert('Erro na requisiçao')
            }
        })
    })
})