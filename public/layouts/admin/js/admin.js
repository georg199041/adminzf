/**
 * Send sync or async request
 * 
 * @param url     string
 * @param options object json
 */
function sendRequest(url, options)
{
	if (options && options.async == false) {
		window.location.href = url;
		return;
	}
	
	options.url = url;
	jQuery.ajax(options);
}

/**
 * call server action
 * 
 * @param action   string|Element|jQuery
 * @param elements array|jQuery|string
 */
function callAction(action, elements)
{
	if (action instanceof Element) {
		action = jQuery(action).attr('formaction');
	} else if (action instanceof jQuery) {
		action = action.attr('formaction');
	}
	
	if (typeof action != 'string' || action == '') {
		throw "Action must be a non empty string or DOM element or jQuery element with non empty formaction attribute";
	}
	
	if (!elements) {
		elements = '';
	}
	
	if (typeof elements == 'string') {
		elements = jQuery(elements).serialize();
	} else if (elements instanceof jQuery) {
		elements = elements.serialize();
	} else if (elements instanceof Array) {
		elements = jQuery.param(elements);
	}
	
	if (typeof elements != 'string') {
		throw "Elements must be passed as string jQuery selector or jQuery collection or array of params for $.param() method";
	}
	
	sendRequest(action + (elements ? '?' : '') + elements, {async:false});
}





/**
 * Prepare tinimce editors before requests
 */
function triggerSaveTinyMCE() {
	if (tinyMCE) {
		for (var i in tinyMCE.editors) {
			tinyMCE.editors[i].save();
		}
	}
}

/**
 * Preprocessing form data here
 */
function observeFormSubmit()
{
	jQuery('form').unbind('submit').bind('submit', function(){
		triggerSaveTinyMCE();
	});
}

/**
 * Observe events on dom tree loaded
 */
jQuery(document).ready(function(){
	observeFormSubmit();
});