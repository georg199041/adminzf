<div class="front-header-menu-container">
	<div class="front-header-menu-left"></div>
	<table height="" cellspacing="0" cellpadding="0" border="0" style="float: left;" class="front-header-menu">
		<tr>
			<td class="front-header-menu-dots">&nbsp;</td>
			<?php if (count($this->getHeaderMenu())): ?>
				<?php foreach ($this->getHeaderMenu() as $page): ?>
					<?php
						if ($page->isActive()) {
							//echo $page->get('meta_keywords');
							$this->headTitle($page->getLabel());
							$this->headMeta()->appendName('keywords', $page->get('meta_keywords'));
							$this->headMeta()->setName('description', $page->get('meta_description'));
						}
					?>
					<td class="front-header-menu__item">
						<a href="<?php echo $page->getHref(); ?>" class="front-header-menu__item-href <?php if ($this->isActive($page)): ?>front-header-menu__item-href_active<?php endif; ?>">
							<span class="front-header-menu-gradient"><?php echo $page->getLabel(); ?></span>
						</a>
					</td>
					<td class="front-header-menu-dots"></td>
				<?php endforeach; ?>
			<?php endif; ?>
		</tr>	
	</table>
	<div class="front-header-menu-right"></div>
</div>