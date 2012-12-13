/**
 * Form script
 */
jQuery(document).ready(function(){
	/**
	 * Add decorate validation required class
	 */
	jQuery('.cbfw-element').addClass('control-group');
	jQuery('.cbfw-element').each(function(){
		if (jQuery(this).hasClass('cbfw-element_error')) {
			jQuery(this).addClass('error');
		}
	});
	
	/**
	 * Validation progress
	 */
	jQuery('.cbfw-block form').on('submit', function(event){
		jQuery(this).find('button').attr('disabled', true);
	});

	/**
	 * Override submit buttons for old browsers handle
	 */
	jQuery('button[name=save], button[name=back]').on('click', function(event){
		event.preventDefault();
		jQuery(this).parents('form').attr('action', jQuery(this).attr('formaction')).trigger('submit');
	});
	
	/**
	 * Override submit buttons for old browsers handle
	 */
	jQuery('button[name=cancel]').on('click', function(event){
		event.preventDefault();
		window.location.href = jQuery(this).attr('formaction');
	});
	
	/**
	 * test
	 */
	jQuery('.cbfw-tag-addbtn-image__select, .cbfw-tag-addbtn-image-hover__select, .cbfw-tag-addbtn-image-left__select, .cbfw-tag-addbtn-image-right__select').on('click', function(){
		mcImageManager.browse({
		    fields : jQuery(this).siblings('input').attr('name'),
		    document_base_url : '/',
	        remove_script_host : true,
	        relative_urls : false
		});
	});
	
	jQuery(".cbfw-tag__image input, .cbfw-tag__image-hover input, .cbfw-tag__image-left input, .cbfw-tag__image-right input").qtip({
		content: '',
		position: { target: 'mouse' },
		api: {
	        beforeShow:function() {
	        	//alert('test');
	        	if (this.elements.target.val()) {
	        		this.updateContent('<img class="img-polaroid" style="display: block; width:230px;" src="' + this.elements.target.val() + '"/>');
	        	} else {
	        		this.updateContent('');
	        	}
	        }
	    },
	    style: {
	    	border: 'none',
	    	width: 250,
	    	overflow: 'visible',
	    	background: 'none'
	    }
	});
	
	/*jQuery(".cbfw-tag__image input").qtip({
	   content: '1',
	   onRender: function(){
		   console.log(123);
	   },
	   style: { 
	      border: {
	         width: 3,
	         radius: 8,
	         color: '#6699CC'
	      },
	      width: 200
	}  });*/
});