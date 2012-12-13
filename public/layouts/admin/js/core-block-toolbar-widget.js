jQuery(document).ready(function(){
	
	/**
	 * BUTTONS DECORATE
	 */
	$("button").addClass("btn");
	$(".cbtw-buttons button").addClass("btn-small");
	$("button[name=add]").addClass("btn-success");
	$("button[name=save]").addClass("btn-success");
	$("button[name=back]").addClass("btn-info");
	$("button[name=delete]").addClass("btn-danger");
	$("button[name=show]").addClass("btn-info");
	$("button[name=hide]").addClass("btn-warning");
	
	/**
	 * 
	 */
	$("button[name=setNotviewed], button[name=setModerated], button[name=setRegected], button[name=show], button[name=hide], button[name=delete]").click(function(event){
		callAction($(this), '.cbgw-column__ids input:checked');
	});
	
	/**
	 * 
	 */
	$("button[name=add]").click(function(event){
		callAction($(this));
	});
	
	
	/**
	 * MODAL DIALOG
	 */
	$("button[name=move], button[name=copy]").click(function(event){
		event.preventDefault();
		if($(".cbgw-column__ids input:checked").length<1){
			$(".messages").append('<li class="message message_error message_unreaded"><a href="#" class="close"></a><span>Не выбрана ни одна запись</span></li>');
			return;
			
		}	
			
			var formaction = $(this).attr("formaction");
			
			var tbl = $('<div><table width="100%" cellspacing="0" cellpadding="0"></table></div>');
			
			tbl.find('table').append('<colgroup><col width="1%"><col></colgroup>');
			
			tbl.find('table').append(
					$('<thead></thead>').append(
							$('<tr></tr>').append(
									$(".cbgw-column__ids input:checked").parents("table").find('.cbgw-header__id, .cbgw-header__label, .cbgw-header__title, .cbgw-header__email').clone()
							)
					)
			);
			
			tbl.find('thead th:first').addClass('cbgw-columnfirst');
			tbl.find('thead th:last').addClass('cbgw-columnlast');
			
			$(".cbgw-column__ids input:checked").each(function(){
				var tr = $('<tr></tr>');
				
				$(this).parents('tr').find('.cbgw-column__id, .cbgw-column__label, .cbgw-column__title, .cbgw-column__email').each(function(){
					tbl.find('table').append(tr.append($(this).clone()));
				});
				
				tr.find('td:first').addClass('cbgw-columnfirst');
				tr.find('td:last').addClass('cbgw-columnlast');
			});
			
			
			var mod = $('<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close admin-close-btn_fix" data-dismiss="modal" aria-hidden="true">×</button><h3 id="myModalLabel">' + $(this).html() + ' в</h3></div><div class="modal-body cbgw-block">' + tbl.html() + '</div><div class="modal-footer"><button class="btn btn-success">' + $(this).html() + '</button><button class="btn" data-dismiss="modal" aria-hidden="true">Назад</button></div></div>').modal();
			
			var parent = $(this).attr("parent");
			var select = $("select[name=filter_"+parent+"]").clone();
			select.attr('name', parent);
			select.attr('id', null);
			select.insertAfter(mod.find('.modal-header button'));
			
			mod.find('.modal-footer .btn-success').click(function(){
				var q = $(".cbgw-column__ids input:checked, .modal-header select");
				window.location.href = formaction + "?" + q.serialize();
			});
		
	});
	
	
	
});