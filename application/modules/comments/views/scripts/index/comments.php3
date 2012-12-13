<?php
$months = array(
	1  => 'Января',
	2  => 'Февраля',
	3  => 'Марта',
	4  => 'Апреля',
	5  => 'Мая',
	6  => 'Июня',
	7  => 'Июля',
	8  => 'Августа',
	9  => 'Сентября',
	10 => 'Октабря',
	11 => 'Ноября',
	12 => 'Декабря',
);
?>
<div class="front-block-comments">
	<h2>Комментарии</h2>
	<?php foreach ($this->getComments() as $comment): ?>
	<div class="front-block-user-comments">
		<div class="front-block-user-comments__tab">
			<span class="front-block-user-comments__tab_before"></span>
			<span class="front-block-user-comments__tab_center">
				<span class="front-block-user-comments__tab_user-name"><?php echo $comment->getName(); ?></span>
				<span class="front-block-user-comments__tab_arrow">&larr;</span>
				<span class="front-block-user-comments__tab_user-data">
					<?php
						$ts = $comment->getCreatedTs();
						echo date('d', $ts) . ' ' . $months[(int) date('n', $ts)] . ' ' . date('Y, H:m:s', $ts);
					?>
				</span>
			</span>
			<span class="front-block-user-comments__tab_after"></span>
		</div>
		<div class="front-block-user-comments-text">
			<?php echo $comment->getComment(); ?>
		</div>
	</div>
	<?php endforeach; ?>
	<div class="front-block-comment-add">
		<h3>Ваш комментарий</h3>
		<?php echo Core::getBlock('comments/index/add-comment'); ?>
		<script>
			$('.cbfw-block-comments_index_add-comment form').ajaxForm({
				beforeSubmit: function(arr, $form, options){
					$form.find('.cbfw-element_required input, .cbfw-element_required textarea')
				         .parents('.cbfw-element')
				         .find('.cbfw-errors')
				         .html('');
				},
				success: function(data, textStatus, jqXHR, $form) {
					if (data.errors) {
						for (var name in data.errors) {
							var ul = $('<ul></ul>');
							for (var code in data.errors[name]) {
								ul.append('<li>' + data.errors[name][code] + '</li>');
							}
							
							$form.find('input[name=' + name + '], textarea[name=' + name + ']')
							     .parents('.cbfw-element')
							     .find('.cbfw-errors')
							     .html(ul);
						}
					}

					if (data.error) { alert(data.error); }
					if (data.success) {
						$form.resetForm();
						alert(data.success);
						window.location.href = window.location.href;
					}
				}
			});
		</script>
	</div>
</div>
