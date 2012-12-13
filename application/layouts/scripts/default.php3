<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="favicon.ico" href="/favicon.ico" type="image/x-icon">
	<?php $this->headTitle($this->__('РОЙ')); ?>
	<?php echo $this->partial('default/head.php3'); ?>
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?63"></script>

	<script type="text/javascript">
	  VK.init({apiId: 3221100, onlyWidgets: true, pageUrl: document.location.hash});
	</script>
	
	<script type="text/javascript" src="http://vk.com/js/api/share.js?11" charset="windows-1251"></script>
	
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
	
</head>
<body>
	<div class="front-fullscreen-wait"></div>
	<div class="front-modal-container"></div>
	<?php echo Core::getBlock('application/default/header'); ?>
	<div class="front-body" style="border: 2px dashed green;">
		<div class="front-push-top"></div>
		
		<?php var_dump(Zend_Controller_Front::getInstance()->getRequest()->getParams()); ?>
		<?php echo Zend_Controller_Front::getInstance()->getRouter()->getCurrentRouteName(); ?>
		<div class="front-push-bottom"></div>
	</div>
	<div class="front-footer">
		<div class="front-footer-width">
			<div class="front-footer-box">
				<div class="front-footer-box-rights">
					<div class="front-footer-box-rights-text">
						copyrights
					</div>
					<div class="front-footer-box-rights-logo">
						logo
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
</body>
</html>