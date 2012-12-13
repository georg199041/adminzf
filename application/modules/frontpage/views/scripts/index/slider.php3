<div class="front-body-slider-body">
	<div class="front-body-slider-top"></div>
	<div class="front-body-slider-blackwhite">
		<ul class="front-body-slider-blackwhite-left">
			<?php $i = 0; ?>
			<?php foreach ($this->getSlides() as $slide): ?>
			<li class="front-body-slider-blackwhite-left__item <?php echo $i == 0 ? 'active' : ''; ?>" style="background-image: url(<?php echo $slide->getImageLeft(); ?>);"></li>
			<?php $i++; ?>
			<?php endforeach; ?>
		</ul>
		<ul class="front-body-slider-blackwhite-right">
		<?php $i = 0; ?>
			<?php foreach ($this->getSlides() as $slide): ?>
			<li class="front-body-slider-blackwhite-right__item <?php echo $i == 0 ? 'active' : ''; ?>" style="background-image: url(<?php echo $slide->getImageRight(); ?>);"></li>
			<?php $i++; ?>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="front-body-slider-color">
		<ul class="front-body-slider-color-wrap">
			<?php $i = 0; ?>
			<?php foreach ($this->getSlides() as $slide): ?>
				<li class="front-body-slider-color__item <?php echo $i == 0 ? 'active' : ''; ?>">
					<img src="<?php echo $slide->getImage(); ?>"
						 bg_left="<?php echo $slide->getImageLeft(); ?>"
						 bg_right="<?php echo $slide->getImageRight(); ?>" />
				</li>
				<?php $i++; ?>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="front-body-slider-rectangle">
		
		<div class="front-body-slider-buttons">
			<?php if ($this->getSlides()->count() > 0): ?>
				<input type="button" id="slider_back" class="slider_buttons" />
				<input type="button" id="slider_next" class="slider_buttons" />
			<?php endif; ?>
		</div>
	</div>
</div>
<div class="front-push-slider"></div>
