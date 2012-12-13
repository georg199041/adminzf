<div id="exception-trace" class="e404-modal-container" style="display:none;">
	<div class="e404-modal-wrapper">
		<div class="e404-modal-header">Подробности фЭЙЛА</div>
		<div class="e404-modal-body">
			<div class="e404-trace-h3">An error occurred:</div>
			<div class="e404-trace-line"><?php echo $this->message ?></div>
			<?php if (isset($this->exception)): ?>
				<div class="e404-trace-h3">Detailed exception information:</div>
				<div class="e404-trace-line"><b>Message:</b> <?php echo $this->exception->getMessage(); ?></div>
				<div class="e404-trace-line"><b>In:</b> <?php echo $this->exception->getFile(); ?>(<?php echo $this->exception->getLine(); ?>)</div>
				<div class="e404-trace-h3">Stack trace:</div>
				<?php $strArray = explode('<br />', nl2br($this->exception->getTraceAsString())); ?>
				<?php foreach ($strArray as $str): ?>
					<?php $pos1 = stripos($str, ' '); $pos2 = stripos($str, ': '); ?>
					<?php if (false !== $pos2): ?>
						<?php $file = substr($str, $pos1, $pos2 - $pos1); ?>
						<?php $class = substr($str, $pos2 + 1); ?>
						<div class="e404-trace-line">
							<?php echo $class; ?>
							<div><?php echo $file; ?></div>
						</div>
					<?php else: ?>
						<?php $class = substr($str, $pos1); ?>
						<div class="e404-trace-line"><?php echo $class; ?></div>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif ?>
			<div class="e404-trace-h3">Stop at route:</div>
			<div class="e404-trace-line"><?php echo Zend_Controller_Front:: getInstance()->getRouter()->getCurrentRouteName(); ?></div>
			<div class="e404-trace-line">
				<div class="e404-trace-h3">Request Parameters:</div>
				<pre class="e404-pre"><?php echo var_export($this->request->getParams(), true) ?></pre>
			</div>
		</div>
	</div>
</div>
