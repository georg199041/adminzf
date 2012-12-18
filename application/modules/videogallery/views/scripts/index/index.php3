<div class="front-body-content">
	<h1>Видеогалерея</h1>
    <div class="front-content-gallery">
    	<?php foreach ($this->getAlbums() as $album): ?>
    		<?php
    			$url = $this->url(array(
					'album_alias' => $album->getAlias(),
					'module'      => 'videogallery',
					'controller'  => 'index',
    				'action'      => 'album'
				), 'videogallery_album', true);
			?>
	    	<div class="front-content-gallery-photos">
	            <a class="front-content-gallery__unit-link" title="<?php echo $album->getTitle(); ?>" href="<?php echo $url; ?>">
	                <?php /*if ($album->getImage()): ?>
			    	<?php
			    		$noImage = false;
			    		try {
			    			echo $this->image($album->getImage(), array(
			    				"alt"   => $album->getTitle()
			    			))->resizeToCrop(178, 120);
			    		} catch (Exception $e) {
							$noImage = true;
						}
			    	?>
			        <?php endif;*/ ?>
			        <img alt="<?php echo $album->getTitle(); ?>"
			             src="/" />
	            </a>
	            <a class="front-content-gallery__description" title="<?php echo $album->getTitle(); ?>" href="<?php echo $url; ?>">
	            	<?php echo $album->getTitle(); ?>
	            </a>
	        </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="front-body-sidebar-left">
    <?php echo Core::getBlock('navigation/index/sidebar-menu'); ?>
</div>