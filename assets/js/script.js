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
			alert('Erro no pode enviar um valor de classificação maior que 5')
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