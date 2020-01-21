$(function(){
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	  })
	$('#uploadFoto').click(function(){
		$('#escolher').trigger('click')
	})
	$('#escolher').on('change',function(){
		$('#enviar').trigger('click') 
	})
	$("#gratis").on("click",function(){
		$('#cobrar').toggle()
		$("label[for=cobrar]").toggle()
	})
	$('input[name=foto_perfil]').on('change',function(e){
        state.foto=e.target.files[0]
        const imgReader=new FileReader()
        imgReader.onloadend=()=>{
            $('#imagem').attr('src',imgReader.result)
        }
        imgReader.readAsDataURL(state.foto)
	})
})
setInterval(login,500)
function login(){
	var largura=screen.width

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