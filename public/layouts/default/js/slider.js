/**
 * Frontpage full width slider
 */
$(document).ready(function(){
	var SLIDER_FX_DUR = 400;
	$("#slider_back").hover(function(){
		$(this).css({
			"background":"url(/layouts/default/images/slider_arrows.png) no-repeat",
			"background-position":"20px center"
		})
	},function(){
		$(this).css({"background":"transparent"});
	});
	
	$("#slider_next").hover(function(){
		$(this).css({
			"background":"url(/layouts/default/images/slider_arrows.png) no-repeat",
			"background-position":"-108px center "
		})
	},function(){
		$(this).css({"background":"transparent"});
	});
	
	var images = [];
	
	$(".front-body-slider-color__item img").each(function(index) {
		images.push($(this).attr("src"));
		images.push($(this).attr("bg_left"));
		images.push($(this).attr("bg_right"));
	});
	
	for (var i = 0; i < images.length -1; i++) {
		var img = new Image();
		img.src = images[i];
	
	}
	
	$('.front-body-slider-buttons .slider_buttons').click(function(){
		var prev = $('.front-body-slider-color__item.active');		
		var prev_left = $(this).parents(".front-body-slider-body").find(".front-body-slider-blackwhite-left__item.active");
		var prev_right = $(this).parents(".front-body-slider-body").find(".front-body-slider-blackwhite-right__item.active");
		
		var next;
		var next_left;
		var next_right;
		
		if ($(this).attr('id') == 'slider_back') {
			if (prev.prev().length > 0) {
				next = prev.prev();
				next_left  = prev_left.prev();
				next_right = prev_right.prev();
			} else {
				next = $('.front-body-slider-color__item:last');
				next_left = $(".front-body-slider-blackwhite-left__item:last");
				next_right = $(".front-body-slider-blackwhite-right__item:last");
			}
		} else if ($(this).attr('id') == 'slider_next') {
			if (prev.next().length > 0) {
				next = prev.next();
				next_left  = prev_left.next();
				next_right = prev_right.next();
			} else {
				next = $('.front-body-slider-color__item:first');
				next_left = $(".front-body-slider-blackwhite-left__item:first");
				next_right = $(".front-body-slider-blackwhite-right__item:first");
			}
		}
		
		if (next) {
			next.css({'zIndex': '2', 'opacity': '1'});
			next_left.css({'zIndex': '2', 'opacity': '1'});
			next_right.css({'zIndex': '2', 'opacity': '1'});
			
			prev.animate({'opacity': '0'}, SLIDER_FX_DUR, function(){
				next.css({'z-index': '3'}).addClass('active');
				$(this).css({'z-index': '1', 'opacity': '1'}).removeClass('active');								
			});
			
			prev_left.animate({'opacity': '0'}, SLIDER_FX_DUR, function(){				
				$(this).parents(".front-body-slider-body").find(".front-body-slider-blackwhite-left__item.active").css({'z-index': '1', 'opacity': '1'}).removeClass('active');
				next_left.css({'z-index': '3'}).addClass('active');				
			});
			
			prev_right.animate({'opacity': '0'}, SLIDER_FX_DUR, function(){			
				$(this).parents(".front-body-slider-body").find(".front-body-slider-blackwhite-right__item.active").css({'z-index': '1', 'opacity': '1'}).removeClass('active');
				next_right.css({'z-index': '3'}).addClass('active');				
			});
		}
	});
});

