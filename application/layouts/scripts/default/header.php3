<?php
/** Application_Block_Default_Header */
?>
<!-- if ie<9 -->
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
		<div class="front-header-infobox" style="border: 2px dashed red;">
			<h2>infobox block</h2>
		</div>
		<?php echo Core::getBlock('navigation/index/header-menu'); ?>
	</div>
</div>