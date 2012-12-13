<div class="front-body-content">
    <h1>Рекомендации</h1>
    <?php $current = $this->getRecommendationsPosts()->current(); ?>
    <div class="front-body-content-picture-big">
    	<?php if ($current->getImage()): ?>
    	<?php
    		$noImage = false;
    		try {
    			echo $this->image($current->getImage(), array(
    				"class" => "front-doc__image",
    				"alt"   => $this->escape($current->getTitle())
    			))->resizeToWidth(423);
    		} catch (Exception $e) {
				$noImage = true;
			}
    	?>
        <?php endif; ?>
        <h2 class="front-doc__title"><?php echo $current->getTitle(); ?></h2>
        <span class="front-doc__description"><?php echo $current->getDescription(); ?></span>
    </div>
    <div class="front-content-arrow_right">
		<div class="front-doc__slider">
			<a class="front-doc-slider__button front-doc-slider_button-back" href="#"></a>
			<div class="front-doc-slider__overflow">
				<ul style="height: <?php echo (int) ($this->getRecommendationsPosts()->count() * 128) - 10; ?>px" index="0">
	            	<?php $i = 0; ?>
	            	<?php foreach ($this->getRecommendationsPosts() as $post): ?>
	            		<?php
	            			$classes = array('front-doc-slider__item');
	            			if (!($i % 2)) {
								$classes[] = 'front-doc-slider_item-left';
							} else {
								$classes[] = 'front-doc-slider_item-right';
							}
							
							if ($i == 0) {
								$classes[] = 'front-doc-slider_item-active';
							}
						?>
						<li class="<?php echo implode(' ', $classes); ?>" index="<?php echo $i; ?>">
							<a href="#" title="<?php echo $this->escape($post->getTitle()); ?>" description="<?php echo $this->escape($post->getDescription()); ?>" image="<?php echo $post->getImage(); ?>">
								<span class="front-doc-slider__item-mask"></span>
								<?php if ($current->getImage()): ?>
						    	<?php
						    		$noImage = false;
						    		try {
						    			echo $this->image($post->getImage(), array(
						    				"alt" => $this->escape($post->getTitle())
						    			))->resizeToFitCanvas(100, 118);
						    		} catch (Exception $e) {
										$noImage = true;
									}
						    	?>
						        <?php endif; ?>
							</a>
						</li>
						<?php if ($i < $this->getRecommendationsPosts()->count() - 1): ?>
							<?php
								$classes = array('front-doc-slider__sep');
								if (!($i % 2)) {
									$classes[] = 'front-doc-slider_sep-l2r';
								} else {
									$classes[] = 'front-doc-slider_sep-r2l';
								}
							?>
							<li class="<?php echo implode(' ', $classes); ?>"><span></span></li>
						<?php endif; ?>
						<?php $i++; ?>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php $buttonClass = !($i % 2) ? ' front-doc-slider_button-right' : ' front-doc-slider_button-left'; ?>
			<a class="front-doc-slider__button front-doc-slider_button-next<?php echo $buttonClass; ?>" href="#"></a>
		</div>
    </div>
</div>
<div class="front-body-sidebar-left">
    <?php echo Core::getBlock('navigation/index/sidebar-menu'); ?>
</div>