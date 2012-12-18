<!-- videogallery block -->
<h1><?php echo $this->getAlbum()->getTitle(); ?></h1>
<?php echo $this->getAlbum()->getDescription(); ?>
<?php $current = $this->getAlbumVideos()->current(); ?>
<div class="front-content-gallery-album">
	<div class="front-photogallery-slider__icons">
		<ul class="front-photogallery-slider__width" style="margin-left: 0; width:<?php echo (int) $this->getAlbumVideos()->count() * 116; ?>px">
			<li class="front-photogallery-slider__active-overlay" style="margin-left: 0;" index="0" inprogress="false"></li>
			<?php $i = 0; ?>
			<?php foreach ($this->getAlbumVideos() as $photo): ?>
				<li class="front-photogallery-slider__item front-photogallery-slider_item-active">
					<a href="#" index="<?php echo $i; ?>">
						<?php /*if ($photo->getImage()): ?>
				    	<?php
				    		$noImage = false;
				    		try {
								$bigImage = "/". $this->image($photo->getImage())->resizeToWidth(570)->getPath();

				    			echo $this->image($photo->getImage(), array(
				    				"image" => $bigImage,
									"description" => $photo->getDescription(),
									"title" => $photo->getTitle(),
				    				"alt"   => $photo->getTitle()
				    			))->resizeToCrop(104, 70);
								
				    		} catch (Exception $e) {
								$noImage = true;
							}
				    	?>
				        <?php endif;*/ ?>
				        <img src="/"
				             width="104"
				             height="70"
				             image="/"
				             description=""
							 title="<?php echo $photo->getTitle(); ?>"
				    		 alt="<?php echo $photo->getTitle(); ?>" />
					</a>
				</li>
				<?php $i++; ?>
			<?php endforeach; ?>
		</ul>
		<a href="#" class="front-photogallery-slider__btn front-photogallery-slider_btn-left"></a>
		<a href="#" class="front-photogallery-slider__btn front-photogallery-slider_btn-right"></a>
	</div>
	<div class="front-photogallery__bigimage">
		<div class="front-photogallery-bigimage__container">
			<!-- <img class="current" alt="<?php /*echo $current->getTitle();*/ ?>" src="<?php /*echo $current->getImage();*/ ?>" /> -->
			<?php /*if ($current->getImage()): ?>
	    	<?php
	    		$noImage = false;
	    		try {
	    			echo $this->image($current->getImage(), array(
	    				"class" => "current",
	    				"alt"   => $current->getTitle()
	    			))->resizeToWidth(570);
	    		} catch (Exception $e) {
					$noImage = true;
				}
	    	?>
	        <?php endif;*/ ?>
	        <img src="/"
	             width="570"
	             class="current"
	             title="<?php echo $current->getTitle(); ?>"
	    		 alt="<?php echo $current->getTitle(); ?>" />
			<a href="#" class="front-photogallery-bigimage__btn front-photogallery-bigimage_btn-left"><span></span></a>
			<a href="#" class="front-photogallery-bigimage__btn front-photogallery-bigimage_btn-right"><span></span></a>
		</div>
		<div class="front-photogallery-bigimage__description">
			<?php echo $current->getDescription(); ?>
		</div>
	</div>
</div>
<!-- /photogallery block -->
