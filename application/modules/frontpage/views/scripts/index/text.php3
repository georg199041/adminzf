<?php if ($this->getText()): ?>
<div class="front-focused-on-results">
	<div class="front-focused-on-results__bg">
		<div class="front-focused-on-results__center">
			<div class="front-focused-on-results__bg-over">
				<div class="front-focused-on-results__content">
					<h1><?php echo $this->getText()->getTitle(); ?></h1>
					<?php echo $this->getText()->getDescription(); ?>
				</div>
				<div class="front_clearfix"></div>
			</div>
			<?php if ($this->getText()->getButtonText() && $this->getText()->getButtonAction()): ?>
			<div class="front-focused-on-results__button-placeholder">
				<a href="<?php echo $this->getText()->getButtonAction(); ?>" class="front-focused-on-results__button">
					<span class="corners"><span class="dots"><?php echo $this->getText()->getButtonText(); ?></span></span>
				</a>
			</div>
			<?php endif; ?>
			<div class="front-focused-on-results__ws"></div>
		</div>
	</div>
</div>
<div class="front-focused-on-results-push"></div>
<?php endif; ?>