/*********************************************/
$(document).ready(function(){
	var PG_ITEM_WIDTH  = 116;
	var PG_FX_STEP_DUR = 400;
	var PG_PAGE_SIZE   = 5;
	var PG_LENGTH      = $('.front-photogallery-slider__item').length;
	var PG_PAGES       = Math.ceil(PG_LENGTH / PG_PAGE_SIZE);
	
	function photogallerySelectIcon(newIndex)
	{
		if (newIndex < 0 || newIndex >= PG_LENGTH) {
			$('.front-photogallery-slider__active-overlay').attr('inprogress', 'false');
			return;
		}
		
		var oldIndex = parseInt($('.front-photogallery-slider__active-overlay').attr('index'));
		var oldPage  = Math.floor(oldIndex / PG_PAGE_SIZE);
		var newPage  = Math.floor(newIndex / PG_PAGE_SIZE);
		
		if (oldPage == newPage) {
			photogalleryEffectIcon(newIndex);
		} else {
			photogalleryEffectPage(newPage);
			setTimeout(function(){
				photogalleryEffectIcon(newIndex);
			}, PG_FX_STEP_DUR / 10);
		}
		
		
		var start = newPage * PG_PAGE_SIZE;
		var end = start + (PG_PAGE_SIZE - 1);
		$('.front-photogallery-slider__item').each(function(index){
			if(index>=start && index<=end){
				var img = new Image();
				img.src = $(this).find("img").attr("image");
			}
		});
		
	}
	
	function photogallerySelectPage(dir)
	{
		var oldIndex   = parseInt($('.front-photogallery-slider__active-overlay').attr('index'));
		var page       = Math.floor(oldIndex / PG_PAGE_SIZE);
		var pageIndex  = page * PG_PAGE_SIZE;
		
		
		
		if (dir == 'left') {
			//if (oldIndex == pageIndex) {
				page -= 1;
			//}
		} else {
			page += 1;
			if ((page * PG_PAGE_SIZE) >= PG_LENGTH) {
				photogallerySelectIcon(PG_LENGTH - 1);
				return;
			}
		}
		
		photogallerySelectIcon(page * PG_PAGE_SIZE);
	}
	
	function photogalleryEffectIcon(index)
	{
		var margin = PG_ITEM_WIDTH * index;
		$('.front-photogallery-slider__active-overlay').attr('index', index)
		$('.front-photogallery-slider__active-overlay').animate({
			"margin-left" : margin + "px"
		}, PG_FX_STEP_DUR, function(){
			var source = $('.front-photogallery-slider__width a[index=' + index + '] img');
			$('.front-photogallery-bigimage__container img').attr('src', source.attr('image'))
			$('.front-photogallery-bigimage__container img').attr('alt', source.attr('alt'))
			$('.front-photogallery-bigimage__container img').attr('title', source.attr('title'))
			$('.front-photogallery-bigimage__description').html(source.attr('description'));
			$('.front-photogallery-slider__active-overlay').attr('inprogress', 'false');
		});		
	}
	
	function photogalleryEffectPage(page)
	{
		var margin = page * PG_ITEM_WIDTH * PG_PAGE_SIZE;
		if (page * PG_PAGE_SIZE >= PG_LENGTH - PG_PAGE_SIZE) {
			margin = (PG_LENGTH - PG_PAGE_SIZE) * PG_ITEM_WIDTH;
		}
		
		$('.front-photogallery-slider__width').animate({
			"margin-left" : "-" + margin + "px"
		}, PG_FX_STEP_DUR);
	}
	
	function photogalleryControlsObserve()
	{
		$('.front-photogallery-slider__item a').bind('click', function(e){
			e.preventDefault();
			var inprogress = $('.front-photogallery-slider__active-overlay').attr('inprogress');
			if (inprogress == 'false') {
				$('.front-photogallery-slider__active-overlay').attr('inprogress', 'true');
				photogallerySelectIcon(parseInt($(this).attr('index')));
			}
		});
		
		$('.front-photogallery-slider__btn').bind('click', function(e){
			e.preventDefault();
			var inprogress = $('.front-photogallery-slider__active-overlay').attr('inprogress');
			if (inprogress == 'false') {
				$('.front-photogallery-slider__active-overlay').attr('inprogress', 'true');
				if ($(this).hasClass('front-photogallery-slider_btn-left')) {
					photogallerySelectPage('left');
				} else {
					photogallerySelectPage('right');
				}
			}
		});
		
		$('.front-photogallery-bigimage__btn').bind('click', function(e){
			e.preventDefault();
			var inprogress = $('.front-photogallery-slider__active-overlay').attr('inprogress');
			if (inprogress == 'false') {
				$('.front-photogallery-slider__active-overlay').attr('inprogress', 'true');
				var index = parseInt($('.front-photogallery-slider__active-overlay').attr('index'));
				
				if ($(this).hasClass('front-photogallery-bigimage_btn-left')) {
					photogallerySelectIcon(index - 1);
				} else {
					photogallerySelectIcon(index + 1);
				}
			}
		});
	}
	
	photogalleryControlsObserve();
});

