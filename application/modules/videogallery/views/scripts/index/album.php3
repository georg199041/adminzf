<!-- container block -->
<div class="front-body-content">
	<!-- comments block -->
	<?php
		$addComment = Core::getBlock('comments/index/add-comment');
		$addComment->setCommentsTable('videogallery_albums');
		$addComment->setCommentsTableId($this->getAlbum()->getId());
		$addComment->setBackUrl($_SERVER['REQUEST_URI']);
		
		$comments = Core::getBlock('comments/index/comments');
		$comments->setCommentsTable('videogallery_albums');
		$comments->setCommentsTableId($this->getAlbum()->getId());
		
		echo $comments;
	?>
	<!-- /comments block -->
</div>
<div class="front-body-sidebar-left">
	<!-- nav block -->
    <?php echo Core::getBlock('navigation/index/sidebar-menu')->forseActivePageUrl('/videogallery.html'); ?>
    <!-- /nav block -->
</div>
<!-- /container block -->