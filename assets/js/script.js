setInterval(Media,500)
function Media(){
	var largura=screen.width

	if(largura<=1024){
		$('.media').css('display','block')
	}else{
		$('.media').css('display','flex')
	}
}
$(function(){
	
	$('#destaques').on('click',function(){
		$('.desq').slideToggle()
		$('.cursos').hide()
	})
	$('#Cursos').on('click',function(){
		$('.cursos').slideToggle()
		$('.desq').hide()
	}) 
	$('#perfil_oculto').on('click',function(){
		$('#perfil').toggle() 
	})
	$('.dropleft').on('show.bs.dropdown', function(e){
		$(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
	  })
	  
	$('.dropleft').on('hide.bs.dropdown', function(e){
		$(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
	})
	$('#uploadFoto').click(function(){
		$('#escolher').trigger('click')
	})
	$('#escolher').on('change',function(){
		$('#enviar').trigger('click') 
	})
	$('.adicionar_curso').on('click',function(){
		var id_aluno=$(this).attr("data-id-aluno")
		var id_curso=$(this).attr("data-id-curso")

		$.ajax({
			url:BASE+"ajax/LiberarCursoGratis",
			type:"POST",
			data:{id_aluno:id_aluno,id_curso:id_curso},
			success:function(){
				alert("Seu curso ja foi liberado")
				window.location.href=BASE+"home/meus_cursos"
			}
		})
	})

	function notificaçoes(){
		$.ajax({
			url:BASE+'ajax/notificacoes',
			dataType:'json',

			success:function(json){
				if(json.length>0){
					var html=""
					var cont=0
					json.forEach((item,ind)=>{
						if(item.tipo=='auth'){
							var foto=item.foto.length>0?BASE+'assets/imagens/usuarios/'+item.foto:BASE+'assets/imagens/usuario.png'
							if(item.lido==0){
								html+=`<button style="color:white" not="${item.id}" type="button" class="dropdown-item lido" data-toggle="modal" data-target="#Notification${ind}">Bate-Papo(nao lida)</button>`
								cont++
								document.getElementById('icon-not').innerHTML=cont
							}else{
								html+=`<button style="color:white" id="lido" not="${item.id}" type="button" class="dropdown-item" data-toggle="modal" data-target="#Notification${ind}">Pedido de autenticação</button>`
							}
							var modal=`<div class="modal fade" id="Notification${ind}" tabindex="-1" role="dialog" aria-labelledby="Notification${ind}" aria-hidden="true">`
							modal+=`<div class="modal-dialog" role="document">`
							modal+=`<div class="modal-content">`
							modal+=` <div class="modal-header" id="back-black">`
							modal+=`<h5 class="modal-title">Solicitação de chat</h5>`
							modal+=`<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>`
							modal+=`</div>`
							modal+=`<div class="modal-body" id="back-black">
							<div class="media"><img src="${foto}" class="ml-3" style="width:70px;height: 70px;border-radius: 35px;">
							<div class="media-body">
							<h3>Pedido de ${item.remetente}</h3>
							<p>Usuario esta solicitando entrar em chat com você</p>
							</div>
							</div>
							</div>`
							modal+=` <div class="modal-footer" id="dark-blue"><button type="button" class="btn btn-dark" data-dismiss="modal">Aceitar</button><button type="button" class="btn btn-dark">Recusar</button>
						  </div>`
							modal+=`</div>`
							modal+=`</div>`
							modal+=`</div>`
							$('#modais').append(modal)
							modal=""
						 }
						 //modificação pendente de tipos de notificações
					})
					document.getElementsByClassName('c_notifica')[0].innerHTML=html
				}
			},
			complete:function(){
				var lidos=document.querySelectorAll('.lido')
				lidos.forEach(function(item){
					$(item).on('click',function(){
						$.ajax({
							url:BASE+'ajax/msgLida/'+this.getAttribute('not'),
							success:function(){
								console.log('lida')
							}
						})
					})
				})
				cont=0
				setTimeout(()=>{notificaçoes()},2000)
			}
		})
	}
	notificaçoes()
	var classificacao=document.querySelectorAll('.classificacao')
	var value_class=0
	var status=0
	
	classificacao.forEach(function(item,ind){
		item.setAttribute('id-class',ind)
		item.setAttribute('set',"false")
		item.addEventListener('mouseover',function(){
			id = this.getAttribute('id-class')

			if(id>0){
				for(let i=0;i<=id;i++){
					classificacao[i].setAttribute('src',BASE+'assets/imagens/Amarela.png')
				}
			}else{
				item.setAttribute('src',BASE+'assets/imagens/Amarela.png')
			}
		})

		item.addEventListener('click',function(){
			value_class=this.getAttribute('id-class')
			$('#envie_class').fadeIn()

			if(status==0){
				for(let i=0;i<=value_class;i++){
					classificacao[i].setAttribute('src',BASE+'assets/imagens/Amarela.png')
					classificacao[i].setAttribute('set',"true")
				}
				status++
			}else{
				for(let i=0;i<=value_class;i++){
					classificacao[i].setAttribute('src',BASE+'assets/imagens/Preta.png')
					classificacao[i].setAttribute('set',"false")
				}
				$('#envie_class').fadeOut()
				status=0
			}
		})

		item.addEventListener('mouseleave',function(){
			classificacao.forEach(function(item){
				if(item.getAttribute('set')=="false"){
					item.setAttribute('src',BASE+'assets/imagens/Preta.png')
				}
			})
		})
	})

	$('#envie_class').on('click',function(){
		value_class=parseInt(value_class)
		if(value_class+1>5){
			alert('Erro no pode enviar um valor de classificação maior que 5 ou igual a zero')
		}else{
			$.ajax({
				url:BASE+'ajax/classificar_curso',
				type:'post',
				data:{classificacao:value_class+1,id_curso:$('#classificar').attr('id-curso')},

				success:function(){
					alert('Muito obrigado por ter classificado')
					window.location.href=window.location.href
				},
				error:function(){
					alert('Erro ao enviar classificação, tente de novo')
				}
			})
		}
	})
}) 