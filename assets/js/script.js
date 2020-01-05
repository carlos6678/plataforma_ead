setInterval(updateArea,500);
function updateArea(){
	try{
		var ratio= 1920/1080;
		var video_largura=$('#video').width()
		var video_altura=video_largura/ratio

		$('#video').css('width',video_largura)
		$('#video').css('height',video_altura)
		
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
setInterval(login,500)
function login(){
	var largura=window.innerWidth

	if(largura<1024){
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
}) 