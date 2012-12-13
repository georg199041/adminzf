/**
 * Toolbar messenger script
 */
jQuery(document).ready(function(){
	window.Application_Block_Admin_Messenger = {
		// Types
		TYPE_ERROR   : 'ERROR',
		TYPE_WARNING : 'WARNING',
		TYPE_SUCCESS : 'SUCCESS',
		TYPE_INFO    : 'INFO',
		
		// Fx durations
		MSG_FX_STEP_DUR: 200,
		MSG_FX_DELAY   : 4000,
		
		// Properties
		timer: null,
		
		// Methods
		init: function()
		{
			/**
			 * Observe show/hide all messages event
			 */
			jQuery('.admin-info__button').live('click', function(event){
				event.preventDefault();
				jQuery('.admin-info .message').removeClass('message_unreaded');
				if (jQuery(this).attr('displayed') != 'true') {
					jQuery('.admin-info .message').css({
						'opacity': '0',
						'display': 'block'
					}).stop(true, true).animate({
						'opacity': '1'
					}, function(){
						jQuery('.admin-info__button').attr('displayed', 'true');
					});
				} else {
					jQuery('.admin-info .message').stop().animate({
						'opacity': '0'
					}, function(){
						jQuery(this).css({
							'opacity': '0',
							'display': 'block'
						});
						jQuery('.admin-info__button').attr('displayed', 'false');
					});
				}
			});
			
			/**
			 * Observe message close event
			 */
			jQuery('.admin-info .message').live('message-close', function(){
				jQuery(this).removeClass('message_unreaded');
				jQuery(this).animate({
					'opacity': '0'
				}, this.MSG_FX_STEP_DUR, function(){
					jQuery(this).animate({
						'height'         : '0',
						'padding-top'    : '0',
						'padding-bottom' : '0',
						'border-width'   : '0',
						'margin'         : '0'
					}, this.MSG_FX_STEP_DUR, function(){
						jQuery(this).css({
							'display'        : 'none',
							'height'         : 'auto',
							'opacity'        : '1',
							'padding-top'    : '7px',
							'padding-bottom' : '7px',
							'border-width'   : '1px',
							'margin'         : '5px'
						});
					});
				});
			});
			
			/**
			 * Observe message close event
			 */
			jQuery('.admin-info .message a.close').live('click', function(event){
				event.preventDefault();
				jQuery(this).parents('.message').trigger('message-close');
			});
			
			this.runAutohider();
		},
		runAutohider: function()
		{
			$this = this;
			this.timer = setTimeout(function(){
				if ($this.getMessages().find('.message_unreaded').length) {
					$this.getMessages().find('.message_unreaded:first').trigger('message-close');
				}	
				$this.runAutohider();
			}, this.MSG_FX_DELAY);
		},
		stopAutohider: function()
		{
			clearTimeout(this.timer);
		},
		getMessenger: function()
		{
			return jQuery('.admin-info');
		},
		getMessages: function()
		{
			return this.getMessenger().find('.messages');
		},
		getCounter: function()
		{
			return this.getMessenger().find('.admin-info__button');
		},
		addMessage: function($message, $type = this.TYPE_INFO)
		{
			var msg = jQuery('<li class="message message_unreaded"><a href="#" class="close"></a><span>' + $message + '</span></li>');
			switch ($type) {
				case this.TYPE_ERROR:
					msg.addClass('message_error');
					break;
				case this.TYPE_WARNING:
					msg.addClass('message_warning');
					break;
				case this.TYPE_SUCCESS:
					msg.addClass('message_success');
					break;
				case this.TYPE_INFO:
				default:
					msg.addClass('message_info');
					break;
			}
			
			this.getMessages().append(msg);
			this.getCounter().text('(' + this.getMessages().find('li').length + ')');
			this.stopAutohider();
			this.runAutohider();
			
			return this;
		},		
		addError: function ($message)
		{
			this.addMessage($message, this.TYPE_ERROR);
			return this;
		},		
		addWarning: function ($message)
		{
			this.addMessage($message, this.TYPE_WARNING);
			return this;
		},		
		addSuccess: function ($message)
		{
			this.addMessage($message, this.TYPE_SUCCESS);
			return this;
		}
	};
	
	Application_Block_Admin_Messenger.init();
});