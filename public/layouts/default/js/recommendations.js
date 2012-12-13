/**
 * Recomendations fx events
 */
$(document).ready(function(){
	var DOC_LENGTH = $('.front-doc-slider__item').length;
	
	function docSetActive(index)
	{
		var $this = $('.front-doc-slider__item[index=' + index + ']');
		
		$('.front-doc-slider__item').removeClass('front-doc-slider_item-active');
		$this.addClass('front-doc-slider_item-active');
		
		// Handle big image + info
		$(".front-doc__image").attr("src", $this.find('a').attr('image'));
		$(".front-doc__image").attr("alt", $this.find('a').attr('title'));
		$(".front-doc__image").attr("title", $this.find('a').attr('title'));
		$(".front-doc__title").html($this.find('a').attr('title'));
		$(".front-doc__description").html($this.find('a').attr('description'));
	}
	
	function docParseNextButtonPosition()
	{
		var diff = DOC_LENGTH - parseInt($('.front-doc-slider__overflow ul').attr('index'));
		if (diff > 4) {
			diff = 4;
		}
		
		if (!(diff % 2)) {
			$('.front-doc-slider_button-next').removeClass('front-doc-slider_button-left').addClass('front-doc-slider_button-right');
		} else {
			$('.front-doc-slider_button-next').removeClass('front-doc-slider_button-right').addClass('front-doc-slider_button-left');
		}
	}
	
	if (DOC_LENGTH > 4) {
		// Show buttons if length more than max in page
		$('.front-doc-slider__button').show();
		docParseNextButtonPosition();
		
		// Handle events
		$('.front-doc-slider__button').click(function(event){
			event.preventDefault();
			var index  = parseInt($('.front-doc-slider__overflow ul').attr('index'));
			var height = $('.front-doc-slider__overflow ul li').height() + 10;
			
			// Handle direction
			if ($(this).hasClass('front-doc-slider_button-next')) {
				if (index + 4 < DOC_LENGTH) {
					$('.front-doc-slider__overflow ul').css({
						'marginTop': '-' + ((index + 4) * height) + 'px'
					});
					
					$('.front-doc-slider__overflow ul').attr('index', index + 4);
					docSetActive(index + 4);
					docParseNextButtonPosition();
				}
			} else if ($(this).hasClass('front-doc-slider_button-back')) {
				//console.log(index);
				if (index >= 4) {
					$('.front-doc-slider__overflow ul').css({
						'marginTop': '-' + ((index - 4) * height) + 'px'
					});
					
					$('.front-doc-slider__overflow ul').attr('index', index - 4);
					docSetActive(index - 4);
					docParseNextButtonPosition();
				}
			}
		});
	}
	
	$('.front-doc-slider__item').click(function(event){
		event.preventDefault();
		docSetActive(parseInt($(this).attr('index')));
	});
	
	
	
	
	
	
	
	
	
	
	//RECOMMENDATIONS
	
	//MINIATURES CLICK
	$(".front-content-carousel__preview-picture a").click(function(event){
		
		event.preventDefault();
		
		var image = $(this).attr("image");
		
		var title = $(this).attr("title");
		
		var description = $(this).attr("description");
		
		$("#recommend-image").attr("src", image);
		$("#recommend-title").html(title);
		$("#recommend-description").html(description);
		
		
		
	});
	//NAVI CLICK
	
	var item_height = 130;
	var step_size   = 4;
	var length      = $('.front-content-carousel__preview-picture').length;
	var move = step_size*item_height;
	
	
	
	
	
//	$(".front-content-arrow_right > a").click(function(event){
//		
//		event.preventDefault();
//		
//		var removed = $(".front-content-carousel ul").position().top;
//		if($(this).hasClass('back')){
//			if(move>=0){
//				$(".front-content-carousel ul").css({"top": "-=" + move});
//				removed = $(".front-content-carousel ul").position().top;
//			}else{
//				removed = $(".front-content-carousel ul").position().top;
//				console.log(length-removed)
//				$(".front-content-carousel ul").css({"top": "-=" + item_height});
//			}
//		}else{
//			if(move<=0){
//				$(".front-content-carousel ul").css({"top": "+=" + move});
//				removed = $(".front-content-carousel ul").position().top;
//			}else{
//				removed = $(".front-content-carousel ul").position().top;
//				console.log(length-removed)
//				$(".front-content-carousel ul").css({"top": "+=" + item_height});
//			}
//		}	
//		
//	});
	

});