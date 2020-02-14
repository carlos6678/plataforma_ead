$(function(){
	
	$('[data-toggle="tooltip"]').tooltip()
	
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
setInterval(Media,500)
function Media(){
	var largura=screen.width

	if(largura<1024){
		$('.media').css('display','block')
	}else{
		$('.media').css('display','flex')
	}
}