<div class="front-body-container__schema">
	<div class="front-result-box-title">
		<span class="front-title-content">УНИКАЛЬНАЯ система<br>восстановления</span>
	</div>
	<!-- Container width + height -->
	<div class="front-schema__container">
		<div class="front-schema__center"></div>
		<div class="front-schema__list">
			<?php $i = 0; ?>
			<?php 
				$colors = array(
					'front-schema-item_orange',
					'front-schema-item_dblue',
					'front-schema-item_brown',
					'front-schema-item_green',
					'front-schema-item_red',
					'front-schema-item_lblue');
			?>
			<?php foreach ($this->getRecoverySystemItems() as $item): ?>
			<?php
				$classes = array($colors[$i]);
				if (!($i % 2)) {
					$classes[] = 'front-schema-item_left';
				} else {
					$classes[] = 'front-schema-item_right';
				}
				
				if ($i == 2 || $i == 3) {
					$classes[] = 'front-schema-item_short';
				} else {
					$classes[] = 'front-schema-item_long';
				}
			?>
			<div class="front-schema__item <?php echo implode(' ', $classes); ?>">
				<div class="front-schema-item__icons">
					<img class="front-schema-item__icon front-schema-item_icon-normal" src="<?php echo $item->getImage(); ?>">
					<img class="front-schema-item__icon front-schema-item_icon-hover" src="<?php echo $item->getImageHover(); ?>">
				</div>
				<div class="front-schema-item__text">
					<div class="front-schema-item__title"><?php echo $item->getTitle(); ?></div>
					<div class="front-schema-item__title-white"><?php echo $item->getTitle(); ?></div>
					<div class="front-schema-item__description"><?php echo $item->getDescription(); ?></div>
				</div>
				<ul class="front-schema-item__dots ie_dots">
					<li></li>
					<li></li>
					<li></li>
					<li></li>
				</ul>
				<div class="front-schema-item__background"></div>
			</div>
			<?php $i++; ?>
			<?php endforeach; ?>
		</div>
	</div>
</div>