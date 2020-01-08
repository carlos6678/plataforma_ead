$(function(){
	$('.professor').click(function(){
		$('#professor').slideToggle('fast')
	})
	$('#privacidade_view').bind('click',function(){
		$('#privacidade').show()
		$('#foto_perfil').css('display','none')
	})
	$('#foto_perfil_view').bind('click',function(){
		$('#foto_perfil').show();
		$('#privacidade').css('display','none')
	})
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	  })
	let editar=document.querySelectorAll("div #editar_curso");
	$("#edit1").on("click",function(){
		$(editar[3]).fadeToggle()
		for(let x in editar){
			if(x!=3){
				$(editar[x]).hide()
			}
		}
	})
	$("#edit2").on("click",function(){
		$(editar[1]).fadeToggle()
		for(let x in editar){
			if(x!=1){
				$(editar[x]).hide()
			}
		}
	})
	$("#edit3").on("click",function(){
		$(editar[2]).fadeToggle()
		for(let x in editar){
			if(x!=2){
				$(editar[x]).hide()
			}
		}
	})
	$("#edit4").on("click",function(){
		$(editar[0]).fadeToggle()
		for(let x in editar){
			if(x!=0){
				$(editar[x]).hide()
			}
		}
	})
})
setInterval(login,500)
function login(){
	var largura=window.innerWidth

	if(largura<=1024){
		$('.login').css('width','600px')
		$('.login').css('height','350px')
		$('#img').css('marginLeft','250px')
		$('.login').css('marginTop','35%')
	}else{
		$('.login').css('width','400px')
		$('.login').css('height','350px')
		$('#img').css('marginLeft','150px')
		$('.login').css('marginTop','10%')
	}
}