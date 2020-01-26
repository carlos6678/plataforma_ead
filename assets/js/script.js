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
}) 