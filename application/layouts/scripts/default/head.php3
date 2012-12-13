<?php

/**
 * All meta tags renders here
 */
//$this->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');
echo $this->headMeta();

?>
<?php

/**
 * All title branch renders here
 */
echo $this->headTitle()->setSeparator(' | ');

?>
<?php

/**
 * All style sheets add here
 */
$this->headLink()->appendStylesheet('/layouts/default/css/style.css');
$this->headLink()->appendStylesheet('/layouts/default/css/front-form.css');
$this->headLink()->appendStylesheet('/layouts/default/css/front-header-menu.css');
$this->headLink()->appendStylesheet('/layouts/default/css/front-recovery-system.css');
$this->headLink()->appendStylesheet('/layouts/default/css/front-slider.css');
echo $this->headLink();

?>

<?php

/**
 * All scripts files add here
 */


$this->headScript()->appendFile('/lib/jquery/jquery-1.8.2.min.js', 'text/javascript');
$this->headScript()->appendFile('/lib/jquery/jquery.form-3.20.js', 'text/javascript');
$this->headScript()->appendFile('/lib/jquery/ui/jquery-ui-1.9.1.custom.min.js', 'text/javascript');
$this->headScript()->appendFile('/layouts/default/js/browser.js', 'text/javascript');

$this->headScript()->appendFile('/layouts/default/js/main.js', 'text/javascript');
$this->headScript()->appendFile('/layouts/default/js/recommendations.js', 'text/javascript');
$this->headScript()->appendFile('/layouts/default/js/photogallery.js', 'text/javascript');
$this->headScript()->appendFile('/layouts/default/js/recovery-system.js', 'text/javascript');
$this->headScript()->appendFile('/layouts/default/js/slider.js', 'text/javascript');

echo $this->headScript();

?>