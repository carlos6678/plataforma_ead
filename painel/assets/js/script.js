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