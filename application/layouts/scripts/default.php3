<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="favicon.ico" href="/favicon.ico" type="image/x-icon">
	<?php $this->headTitle($this->translate('РОЙ')); ?>
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
	<div class="front-body">
		<div class="front-push-top"></div>
		<?php if ($this->isHomePage()): ?>
		<?php echo Core::getBlock('frontpage/index/slider'); ?>
		<?php endif; ?>
		<div class="front-body-container front_clearfix">
			<?php echo $this->partial('default/body.php3'); ?>
			<div class="front_clearfix"></div>
		</div>
		<?php if ($this->isHomePage()): ?>
		<?php echo Core::getBlock('frontpage/index/text'); ?>
		<?php endif; ?>
		<?php var_dump(Zend_Controller_Front::getInstance()->getRequest()->getParams()); ?>
		<div class="front-push-bottom"></div>
	</div>
	<div class="front-footer">
		<div class="front-footer-width">
			<div class="front-footer-box">
				<div class="front-footer-box-rights">
					<div class="front-footer-box-rights-text">
						© Клуб «РОЙ», 2012. Все права защищены
					</div>
					<div class="front-footer-box-rights-logo">
						<a href="http://sunny.net.ua/" target="_blank" class="front-footer-box-rights-logo-a"></a>					
					</div>
				</div>
				<div class="front-footer-box-line"></div>
			</div>
		</div>
	</div>
	
</body>
</html>