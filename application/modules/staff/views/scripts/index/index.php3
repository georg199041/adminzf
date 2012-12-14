<div class="front-body-content">
    <h1>Персонал</h1>
    <?php foreach ($this->getStaff() as $post): ?>
    <div class="front-content-personal">
    	<?php if ($post->getImage()): ?>
    	<?php
    		$noImage = false;
    		try {
    			echo $this->image($post->getImage(), array(
    				"class" => "front-content-personal__photo",
    				"alt"   => $post->getName()
    			))->resizeToCrop(110, 150);
    		} catch (Exception $e) {
				$noImage = true;
			}
    	?>
        <?php endif; ?>
        <div class="front-content-personal-employee" <?php echo !$post->getImage() || $noImage ? 'style="width: 618px;"' : ''; ?>>
            <h4><?php echo $post->getName(); ?></h4>
            <div class="front-content-personal-employee-text" <?php echo !$post->getImage() || $noImage ? 'style="width: auto;"' : ''; ?>>
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