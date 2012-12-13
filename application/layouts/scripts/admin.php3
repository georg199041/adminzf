<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $this->headTitle('Администратор'); ?>
	<?php echo $this->partial('admin/head.php3'); ?>
</head>
<body>
	<div class="layout_fullscreen_wait"></div>
	<div class="modal_container"></div>
	<?php echo $this->partial('admin/header.php3'); ?>
	<div class="layout_body">
		<div class="layout_push_top"></div>
		<div class="layout_body_container">
			<?php echo $this->partial('admin/body.php3'); ?>
		</div>
		<div class="layout_push_bottom"></div>
	</div>
	<div class="layout_footer">
		<div class="layout_footer_width">
			<div class="layout_footer_text"><img src="/uploads/index.png" style="
				display: block;
			    height: 32px;
			    margin: -4px auto 0;
			    text-align: center;
			    width: 33px;">
		    </div>
		</div>
	</div>
</body>
</html>