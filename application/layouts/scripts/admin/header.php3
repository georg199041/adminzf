<div class="layout_header">
	<div class="layout_header_width">
		<a class="layout_logo_text" <?php
			if (Zend_Auth::getInstance()->hasIdentity()) {
				echo 'href="' . $this->url(Core::urlToOptions('default/admin-index/index'), null, true) . '"';
			}
		?>>Администратор</a>
		<?php if (Zend_Auth::getInstance()->hasIdentity()): ?>
		<div class="layout_header_menu">
			<?php
				$root = Zend_Registry::get('Zend_Navigation')->findOneById('default/admin-index/index');
				echo $this->navigation($root)
				          ->menu()
				          ->render();
			?>
		</div>
		<?php endif; ?>
		<?php if (Zend_Auth::getInstance()->hasIdentity()): ?>
		<div class="admin-logout">
			<a href="<?php echo $this->url(Core::urlToOptions('users/admin-users/logout'), null, true); ?>" class="admin-logout__button"></a>
		</div>
		<?php endif; ?>
		<div class="admin-info">
			<a href="#" class="admin-info__button"><?php
				if (Core::getBlock('application/admin/messenger')->getMessagesCount() > 0) {
					echo '(' . Core::getBlock('application/admin/messenger')->getMessagesCount() . ')';
				}
			?></a>
			<?php echo Core::getBlock('application/admin/messenger'); ?>
		</div>
	</div>
</div>