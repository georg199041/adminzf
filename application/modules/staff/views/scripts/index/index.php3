<div class="front-body-content">
    <h1>Персонал</h1>
    <?php foreach ($this->getStaff() as $post): ?>
    	<?php
    		$noImage = true;
    		$img = false;
    		if ($post->getImage()) {
	    		try {
	    			$img = $this->image($post->getImage(), array(
	    				"class" => "front-content-personal__photo",
	    				"alt"   => $post->getName()
	    			))->resizeToCrop(110, 150);
	    			$noImage = false;
	    		} catch (Exception $e) {}
			}
		?>
	    <div class="front-content-personal <?php echo (false === $noImage) ? 'front-personal_with-img' : ''; ?>">
	    	<?php if (false === $noImage): ?>
	    	<?php echo $img; ?>
	    	<?php endif; ?>
	        <div class="front-content-personal-employee">
	            <h4><?php echo $post->getName(); ?></h4>
	            <div class="front-content-personal-employee-text">
	            	<?php if ($post->getDescription()): ?>
	                <p><?php echo $post->getDescription(); ?></p>
	                <?php endif; ?>
	                <?php if ($post->getPhone()): ?>
	                <span class="front-content-personal-employee-text__contact-details"><?php echo $post->getPhone(); ?></span>
	                <?php endif; ?>
	                <?php if ($post->getEmail()): ?>
	                <span class="front-content-personal-employee-text__contact-details"><a href="mailto:<?php echo $post->getEmail(); ?>"><?php echo $post->getEmail(); ?></a></span>
	                <?php endif; ?>
	                <?php if ($post->getSkype()): ?>
	                <span class="front-content-personal-employee-text__contact-details">Skype:<a href=""><?php echo $post->getSkype(); ?></a></span>
	                <?php endif; ?>
	            </div>
	        </div>
	    </div>
    <?php endforeach; ?>
</div>
<div class="front-body-sidebar-left">
    <?php echo Core::getBlock('navigation/index/sidebar-menu'); ?>
</div>