setInterval(updateArea,500);
function updateArea(){
	try{
		if(window.innerWidth<=1024){
			if(window.innerWidth<=320){
				$('#busca').css('width','160px')
			}else{
				$('#busca').css('width','200px')
			}
		}else{
			$('#busca').css('width','500px')
		}
	}catch(e){
		//gtdhfffygftfyufttffddgfdfghfgffghf
	}
 
}
setInterval(ajuste,500)
function ajuste(){
	var largura=screen.width

	if(largura<=1024){
		$('.login').css('width','600px')
		$('.login').css('height','350px')
		$('#img').css('marginLeft','250px')
		$('.login').css('marginTop','35%')
		$('.media').css('display','block')
	}else{
		$('.login').css('width','400px')
		$('.login').css('height','350px')
		$('#img').css('marginLeft','150px')
		$('.login').css('marginTop','10%')
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
}) 