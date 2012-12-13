<?php

/**
 * All meta tags renders here
 */
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
$this->headLink()->appendStylesheet('/layouts/e404/css/style.css');
echo $this->headLink();

?>
<?php

/**
 * All scripts files add here
 */
$this->headScript()->appendFile('/lib/jquery/jquery-1.8.2.min.js', 'text/javascript');
$this->headScript()->appendFile('/lib/jquery/ui/jquery-ui-1.9.1.custom.min.js', 'text/javascript');

$this->headScript()->appendFile('/layouts/default/js/main.js', 'text/javascript');
echo $this->headScript();

?>
