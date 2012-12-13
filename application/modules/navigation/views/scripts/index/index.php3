<style>
.template_name_highlighter {
	background-color: #f0f0f0;
	display: inline-block;
	border: 1px solid #e0e0e0;
	border-radius: 3px;
	padding: 3px;
	font-size: 10px;
	font-family: Arial;
}
</style>
<div class="template_name_highlighter">
	<?php echo __FILE__; ?>
</div>
<?php// echo $this->image('/uploads/slide1.jpg', array('width' => '20'))->resizeToCrop(100, 100); ?>
<?php //echo $this->getBlock('default/index/grid'); ?>
<?php echo get_class($this); ?>