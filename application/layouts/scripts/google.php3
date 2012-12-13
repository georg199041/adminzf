<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $this->headTitle($this->translate('РОЙ')); ?>
	<?php $this->headScript()->appendFile('http://maps.google.com/maps/api/js?sensor=false', 'text/javascript'); ?>
	<?php echo $this->partial('default/head.php3'); ?>
</head>
<body class="front-map-page">
	<div class="front-fullscreen-wait"></div>
	<div class="front-modal-container"></div>
	<?php echo Core::getBlock('application/default/header'); ?>
	<div class="front-body">
		<div id="front-fullscreen-map" class="front-fullscreen-map"></div>
		<script type="text/javascript">
			<?php
				$contact = Core::getBlock('contacts/index/index')->getCrimeaBaseContacts();
				$description = $contact->getTitle();
				$lat = 44.836213;
				$lng = 34.324379;
				if ($contact) {
					list($lat, $lng) = explode(',', strip_tags($contact->getContactLatlng()->getDescription()));
					$lat = (float) trim($lat);
					$lng = (float) trim($lng);
				}
			?>
			var map, marker;
			$(document).ready(function(){
				var options = {
					zoom:      14,
					center:    new google.maps.LatLng((<?php echo $lat; ?> - 0.005), (<?php echo $lng; ?> + 0.025)),
					mapTypeId: google.maps.MapTypeId.HYBRID
				};

				map = new google.maps.Map(document.getElementById("front-fullscreen-map"), options);

				marker = new google.maps.Marker({
					position: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),
					map:      map,
					title:    "<?php echo $description; ?>",
					icon:     "/layouts/default/images/map-marker.png"
				});
			});

    		function updateMap(lat, lng, title)
    		{
    			lat = parseFloat(lat);
				lng = parseFloat(lng);
				
				if (map) {
            		map.setCenter(new google.maps.LatLng((lat - 0.005), (lng + 0.025)));
            		if (marker) {
        				marker = new google.maps.Marker({
        					position: new google.maps.LatLng(lat, lng),
        					map:      map,
        					title:    title,
        					icon:     "/layouts/default/images/map-marker.png"
        				});
            		}
        		}
    		}
		</script>
		<div class="front-push-top"></div>
		<div class="front-body-container">
			<?php echo $this->partial('default/body.php3'); ?>
		</div>
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
						<a href="/" class="front-footer-box-rights-logo-a"></a>					
					</div>
				</div>
				<div class="front-footer-box-line"></div>
			</div>
		</div>		
	</div>
</body>
</html>