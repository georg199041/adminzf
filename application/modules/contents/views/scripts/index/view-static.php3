<div class="front-body-content">
    <div class="front-body-content-static">
    	<h1><?php echo $this->getPost()->getTitle(); ?></h1>
    	<?php echo $this->getPost()->getFulltext(); ?>
    </div>
</div>
<div class="front-body-sidebar-left">
    <?php echo Core::getBlock('navigation/index/sidebar-menu'); ?>
</div>