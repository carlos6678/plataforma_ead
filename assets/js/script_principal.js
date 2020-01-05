setInterval(updateArea,1000);
function updateArea(){
	var ratio= 1920/1080;
	var video_largura=$('#video').width()
	var video_altura=video_largura/ratio
	
	$('#video').css('width',video_largura)
	$('#video').css('height',video_altura)
	$('#frame').css('height',video_altura)
		

}
$(function(){
	$('.curso').each(function(){
		$(this).hover(function(){
			$(this).animate({
				'width':210
			},100)
		},function(){
			$(this).animate({
				'width':200,
				'border-radius':0
			},100)
		})
	})
})