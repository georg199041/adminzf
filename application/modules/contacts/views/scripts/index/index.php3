<div class="front-content-contact">
    <div class="front-content-contacts">
        <div class="front-content-contacts-header">
            <?php if ($this->getCrimeaBaseContacts()): ?>
            	<a href="#contacts-crimea" rel="#contacts-crimea">База в Крыму</a>
            <?php endif; ?>
            <?php if ($this->getMoscowOfficeContacts()): ?>
            	<a href="#contacts-moscow" rel="#contacts-moscow">Офис в Москве</a>
            <?php endif; ?>
            <a href="#contacts-form" rel="#contacts-form">Обратная связь</a>
        </div>
        <div class="front-content-contacts-body">
	        <?php if ($this->getCrimeaBaseContacts()): ?>
		        <?php $contacts = $this->getCrimeaBaseContacts(); ?>
		        <div id="contacts-crimea" class="tab front-content-contacts-address-form">
		            <strong>Адрес:</strong><br />
		            <div><?php echo $contacts->getDescription(); ?></div>
		            <?php if ($contacts->getContactAddress()): ?>
		            	<?php echo $contacts->getContactAddress()->getDescription(); ?>
		            <?php endif; ?>
		            <div class="front-content-contacts-address-form_left">
		            	<?php if ($contacts->getContactMainphone() || $contacts->getContactPhones()->count() > 0): ?>
		                	<strong class="front-content-contacts-address-form__headline">Контактные телефоны:</strong>
		                	<?php if ($contacts->getContactMainphone()): ?>
		                		<span><?php echo $contacts->getContactMainphone()->getDescription(); ?></span>
		                	<?php endif; ?>
		                	<?php if ($contacts->getContactPhones()->count() > 0): ?>
		                		<?php foreach ($contacts->getContactPhones() as $phone): ?>
		                			<span><?php echo $phone->getDescription(); ?></span>
		                		<?php endforeach; ?>
		                	<?php endif; ?>
		                <?php endif; ?>
		                <?php if ($contacts->getContactEmail()): ?>
		                	<?php $email = $contacts->getContactEmail()->getDescription(); ?>
		                	<strong class="front-contacts-address-form_left__electronic-information">Почта: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></strong>
		                <?php endif; ?>
		                <?php if ($contacts->getContactSkype()): ?>
		                	<strong class="front-contacts-address-form_left__electronic-information">Skype: <a href=""><?php echo $contacts->getContactSkype()->getDescription(); ?></a></strong>
		                <?php endif; ?>
		                <?php if ($contacts->getContactLatlng()): ?>
               				<?php
               					list($lat, $lng) = explode(',', strip_tags($contacts->getContactLatlng()->getDescription()));
               					$lat = trim($lat);
               					$lng = trim($lng);
               				?>
		                	<strong class="front-contacts-address-form_left__electronic-information">Координаты GPS: <span class="front-contacts-address-form_left__navigation" description="База в Крыму" lat="<?php echo $lat; ?>" lng="<?php echo $lng; ?>"><?php echo $contacts->getContactLatlng()->getDescription(); ?></span></strong>
		                	<script>
		                		$('.front-content-contacts-header a[rel=#contacts-crimea]').click(function(){
			                		var el = $('#contacts-crimea .front-contacts-address-form_left__navigation');
	                				updateMap(el.attr('lat'), el.attr('lng'), el.attr('description'));
		                		});
		                	</script>
		                <?php endif; ?>
		            </div>
		            <?php if ($contacts->getContactQrcode()): ?>
		            <div class="front-content-contacts-address-form_right">
		                <strong class="front-content-contacts-address-form__headline">QR код</strong>
		                <img class="front-content-contacts-address-form__qr" alt="" src="<?php echo $contacts->getContactQrcode()->getImage(); ?>" />
		            </div>
		            <?php endif; ?>
		        </div>
	        <?php endif; ?>
	        <?php if ($this->getMoscowOfficeContacts()): ?>
	        	<?php $contacts = $this->getMoscowOfficeContacts(); ?>
	        	<div id="contacts-moscow" class="tab front-content-contacts-address-form">
		            <strong>Адрес:</strong><br />
		            <div><?php echo $contacts->getDescription(); ?></div>
		            <?php if ($contacts->getContactAddress()): ?>
		            	<div><p><?php echo $contacts->getContactAddress()->getDescription(); ?></p></div>
		            <?php endif; ?>
		            <div class="front-content-contacts-address-form_left">
		            	<?php if ($contacts->getContactMainphone() || $contacts->getContactPhones()->count() > 0): ?>
		                	<strong class="front-content-contacts-address-form__headline">Контактные телефоны:</strong>
		                	<?php if ($contacts->getContactMainphone()): ?>
		                		<span><?php echo $contacts->getContactMainphone()->getDescription(); ?></span>
		                	<?php endif; ?>
		                	<?php if ($contacts->getContactPhones()->count() > 0): ?>
		                		<?php foreach ($contacts->getContactPhones() as $phone): ?>
		                			<span><?php echo $phone->getDescription(); ?></span>
		                		<?php endforeach; ?>
		                	<?php endif; ?>
		                <?php endif; ?>
		                <?php if ($contacts->getContactEmail()): ?>
		                	<?php $email = $contacts->getContactEmail()->getDescription(); ?>
		                	<strong class="front-contacts-address-form_left__electronic-information">Почта: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></strong>
		                <?php endif; ?>
		                <?php if ($contacts->getContactSkype()): ?>
		                	<strong class="front-contacts-address-form_left__electronic-information">Skype: <a href=""><?php echo $contacts->getContactSkype()->getDescription(); ?></a></strong>
		                <?php endif; ?>
		                <?php if ($contacts->getContactLatlng()): ?>
               				<?php
               					list($lat, $lng) = explode(',', strip_tags($contacts->getContactLatlng()->getDescription()));
               					$lat = trim($lat);
               					$lng = trim($lng);
               				?>
		                	<strong class="front-contacts-address-form_left__electronic-information">Координаты GPS: <span class="front-contacts-address-form_left__navigation" description="Офис в Москве" lat="<?php echo $lat; ?>" lng="<?php echo $lng; ?>"><?php echo $contacts->getContactLatlng()->getDescription(); ?></span></strong>
		                	<script>
		                		$('.front-content-contacts-header a[rel=#contacts-moscow]').click(function(){
			                		var el = $('#contacts-moscow .front-contacts-address-form_left__navigation');
	                				updateMap(el.attr('lat'), el.attr('lng'), el.attr('description'));
		                		});
		                	</script>
		                <?php endif; ?>
		            </div>
		            <?php if ($contacts->getContactQrcode()): ?>
		            <div class="front-content-contacts-address-form_right">
		                <strong class="front-content-contacts-address-form__headline">QR код</strong>
		                <img class="front-content-contacts-address-form__qr" alt="" src="<?php echo $contacts->getContactQrcode()->getImage(); ?>" />
		            </div>
		            <?php endif; ?>
	            </div>
	        <?php endif; ?>
	        <div id="contacts-form" class="tab front-content-contacts-form">
		        <?php echo Core::getBlock('contacts/index/feedback'); ?>
	        </div>
        </div>
        <script>
        	$('.front-content-contacts-body .tab').hide();
        	$('.front-content-contacts-body .tab:first-child').show();
        	$('.front-content-contacts-header a:first-child').addClass('front-content-contacts-header__tab_active');
        	
        	$('.front-content-contacts-header a').click(function(event){
            	//event.preventDefault();
            	$('.front-content-contacts-header a').removeClass('front-content-contacts-header__tab_active');
            	$(this).addClass('front-content-contacts-header__tab_active');

            	$('.front-content-contacts-body .tab').hide();
            	$('.front-content-contacts-body ' + $(this).attr('rel')).show();
            });

        	$('.cbfw-block-contacts_index_feedback form').ajaxForm({
				beforeSubmit: function(arr, $form, options){
					$form.find('.cbfw-element_required input, .cbfw-element_required textarea')
				         .parents('.cbfw-element')
				         .find('.cbfw-errors')
				         .html('');
				},
				success: function(data, textStatus, jqXHR, $form) {
					if (data.errors) {
						for (var name in data.errors) {
							var ul = $('<ul></ul>');
							for (var code in data.errors[name]) {
								ul.append('<li>' + data.errors[name][code] + '</li>');
							}
							
							$form.find('input[name=' + name + '], textarea[name=' + name + ']')
							     .parents('.cbfw-element')
							     .find('.cbfw-errors')
							     .html(ul);
						}
					}

					if (data.error) { alert(data.error); }
					if (data.success) {
						$form.resetForm();
						alert(data.success);
						window.location.href = window.location.href;
					}
				}
			});
		</script>
    </div>
</div>