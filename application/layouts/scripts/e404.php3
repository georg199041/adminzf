<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $this->headTitle($this->translate('Roy')); ?>
	<?php echo $this->partial('e404/head.php3'); ?>
</head>
<body>
	<div class="e404-header">
		<div class="e404-header-width">
			<a class="e404-logo" href="/"></a>
			<div class="e404-header-text">Возможно, когда-то тут была страница, но сейчас ее нет. <a href="/">На главную</a></div>
		</div>
	</div>
	<div class="e404-body">
		<?php echo $this->layout()->content; ?>
		<div class="e404-push-top"></div>
		<div class="e404-body-container"></div>
		<div class="e404-push-bottom"></div>
	</div>
	<div class="e404-footer">
		<div class="e404-footer-width">
			<a class="e404-footer-developer-logo" href="http://sunny.net.ua"></a>
		</div>
	</div>
</body>
</html>