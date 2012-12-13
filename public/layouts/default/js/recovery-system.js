/**
 * Recovery system fx events
 */
$(document).ready(function(){
	var SCHEMA_FX_DUR = 250;
	
	$('.front-schema__item').hover(function(){
		var $this = $(this);
		$(this).find(".front-schema-item__dots li").stop().animate({"paddingRight":"0", "paddingLeft":"0"}, SCHEMA_FX_DUR);
		
		$(this).find(".front-schema-item__title").hide();
		$(this).find(".front-schema-item__description").show();
		$(this).find(".front-schema-item__title-white").show();
		
		$(this).find(".front-schema-item_icon-normal").stop().animate({
			"width":"129px",
			"height":"149px",
			"marginTop": "0",
			"marginLeft": "0",
			"marginRight": "0",
			"opacity": "0"
		}, SCHEMA_FX_DUR);
		$(this).find(".front-schema-item_icon-hover").stop().animate({
			"width":"129px",
			"height":"149px",
			"marginTop": "0",
			"marginLeft": "0",
			"marginRight": "0",
		}, SCHEMA_FX_DUR);
		
		$(this).find(".front-schema-item__background").stop().delay(SCHEMA_FX_DUR).animate({"width":"100%"}, SCHEMA_FX_DUR);
	},function(){
		var $this = $(this);
		$(this).find(".front-schema-item__dots li").stop().animate({"paddingRight":"1px", "paddingLeft":"5px"}, SCHEMA_FX_DUR);
		
		$(this).find(".front-schema-item__title-white").hide();
		$(this).find(".front-schema-item__description").hide();
		$(this).find(".front-schema-item__title").show();
		
		$(this).find(".front-schema-item_icon-normal").stop().animate({
			"width":"86px",
			"height":"101px",
			"marginTop": "25px",
			"marginLeft": "22px",
			"marginRight": "22px",
			"opacity": "1"
		}, SCHEMA_FX_DUR);
		$(this).find(".front-schema-item_icon-hover").stop().animate({
			"width":"86px",
			"height":"101px",
			"marginTop": "25px",
			"marginLeft": "22px",
			"marginRight": "22px"
		}, SCHEMA_FX_DUR);
		
		$(this).find(".front-schema-item__background").stop().animate({"width":"0%"}, SCHEMA_FX_DUR / 2);
	});
});