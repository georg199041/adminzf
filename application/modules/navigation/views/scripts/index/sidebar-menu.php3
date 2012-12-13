<?php $sidebar = $this->getSidebarMenu(); ?>
<?php if (count($sidebar)): ?>
	<ul>
		<li>
			<a class="front-body-sidebar-left_top" href="<?php echo $sidebar->getHref(); ?>"><?php echo $sidebar->getLabel(); ?></a>
		</li>
		<li class="front-body-sidebar-left_indent"></li>
		<?php foreach ($sidebar as $item): ?>
			<?php
				if ($item->isActive()) {
					
				}
			?>
			<li>
				<a class="front-body-sidebar-left_center <?php if ($item->isActive()): ?>front-body-sidebar-left_active<?php endif; ?>" href="<?php echo $item->getHref(); ?>">
					<?php echo $item->getLabel(); ?>
				</a>
			</li>
		<?php endforeach; ?>
		<li class="front-body-sidebar-left_bottom"></li>
	</ul>
<?php endif; ?>