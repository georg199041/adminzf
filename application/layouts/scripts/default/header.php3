<?php
/** Application_Block_Default_Header */
?>
<div id="getBrowser" style="display: none;">
 <div class="info">
  <div title="Скрыть" class="close">
  </div>
  <div>
   Вы используете устаревший браузер.<br />Чтобы использовать все возможности сайта, загрузите и установите один из этих браузеров: 
   <div class="hrefs">
    <a class="browser chrome" href="http://www.google.com/chrome/">Google Chrome</a> <a class="browser firefox" href="http://www.mozilla-europe.org/">Mozilla Firefox</a> <a class="browser opera" href="http://www.opera.com/">Opera</a> <a class="browser safari" href="http://www.apple.com/safari/">Safari</a> <br clear="all" />
   </div>
  </div>
 </div>
</div>
<div class="front-header">
	<div class="front-header-width">
		<div class="front-header-infobox">
			<div class="front-header-cords front-header-cords__left">
				<?php if ($this->getMoscowOfficeMainPhone()->getId() || $this->getMoscowOfficeAddress()->getId()): ?>
				<div class="front-header-cords__item">
					<div class="front-header-cords__item-title">
						<b>Координаты в Москве:</b>
					</div>
					<div class="front-header-cords__item-content">
						<?php if ($this->getMoscowOfficeAddress()->getId()): ?>
						<div class="front-header-cords__item-content-text">
							<?php echo $this->getMoscowOfficeAddress()->getDescription(); ?>
						</div>
						<?php endif; ?>
						<?php if ($this->getMoscowOfficeMainPhone()->getId()): ?>
						<div class="front-header-cords__item-content-text">
							<?php echo $this->getMoscowOfficeMainPhone()->getDescription(); ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
				<?php if ($this->getCrimeaBaseMainPhone()->getId()): ?>
				<div class="front-header-cords__item">
					<div class="front-header-cords__item-title">
						Основной телефон в Украине:
					</div>
					<div class="front-header-cords__item-content">
						<div class="front-header-cords__item-content-text">	
							<?php echo $this->getCrimeaBaseMainPhone()->getDescription(); ?>
						</div>	
					</div>	
				</div>
				<?php endif; ?>
			</div>
			<div class="front-header-cords front-header-cords__right">
				<div class="front-header-cords__item">
					<div class="front-header-cords__item-title">
						База Клуба на картах:
					</div>
					<div class="front-header-cords__item-content">
						<div class="front-header-cords__item-content-map">	
							<span class="front-header-cords__item-content-map__item">	
								<span class="front-header-cords__item-content-map__item-ico"></span>
								<a href="https://maps.google.com/maps?q=44.836213,34.324379&hl=ru&ll=44.839317,34.33013&spn=0.05161,0.132093&sll=49.987204,36.273107&sspn=0.374381,1.056747&t=m&z=14" target="_blank" class="front-header-cords__item-content-map__item-href">	
									Google
								</a>
							</span>
							<span class="front-header-cords__item-content-map__item">	
								<span class="front-header-cords__item-content-map__item-ico"></span>
								<a href="http://maps.yandex.ua/-/CVB54XJu" target="_blank" class="front-header-cords__item-content-map__item-href">	
									Яндекс
								</a>
							</span>
						</div>
					</div>
				</div>
				<div class="front-header-cords__item front_socials-margin">
					<div class="front-header-cords__item-title">
						Расскажите о нас друзьям:
					</div>
					<?php $host = ($_SERVER['HTTPS'] == 'ON' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>
					<div class="front-header-cords__item-content">
						<div class="front-header-cords__item-content_socials">
							<a href="http://vk.com/share.php?url=<?php echo $host ?>" target="_blank" class="front-header-cords__item-content_socials__item front_header-vk"></a>
							<a href="http://www.facebook.com/sharer.php?u=<?php echo $host ?>" target="_blank" class="front-header-cords__item-content_socials__item front_header-fb"></a>
							<a href="http://twitter.com/intent/tweet?source=webclient&text=<?php echo $host ?>" target="_blank" class="front-header-cords__item-content_socials__item front_header-tw"></a>
							<a href="<?php echo $host ?>" target="_blank" class="front-header-cords__item-content_socials__item front_header-google"><g:plusone></g:plusone></a>
						</div>	
					</div>	
				</div>
			</div>
			<a class="front-logo-text" href="/"></a>
		</div>
		<?php echo Core::getBlock('navigation/index/header-menu'); ?>
	</div>
</div>