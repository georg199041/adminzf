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
$this->headLink()->appendStylesheet('/lib/bootstrap/css/bootstrap.min.css');
$this->headLink()->appendStylesheet('/layouts/admin/css/style.css');
$this->headLink()->appendStylesheet('/layouts/admin/css/core-block-toolbar-widget.css');
$this->headLink()->appendStylesheet('/layouts/admin/css/core-block-form-widget.css');
$this->headLink()->appendStylesheet('/layouts/admin/css/core-block-grid-widget.css');
$this->headLink()->appendStylesheet('/layouts/admin/css/application-admin-messenger.css');
echo $this->headLink();

?>
<?php

/**
 * All scripts files add here
 */
$this->headScript()->appendFile('/lib/jquery/jquery-1.8.2.min.js', 'text/javascript');
$this->headScript()->appendFile('/lib/jquery/ui/jquery-ui-1.9.1.custom.min.js', 'text/javascript');
$this->headScript()->appendFile('/lib/bootstrap/js/bootstrap.min.js', 'text/javascript');
$this->headScript()->appendFile('/layouts/admin/js/jquery.qtip-1.0.0-rc3.min.js', 'text/javascript');

//$this->headScript()->appendScript('jQuery.noConflict();', 'text/javascript');
$this->headScript()->appendFile('/lib/tinymce/tiny_mce_gzip.js', 'text/javascript');
$this->headScript()->appendFile('/layouts/admin/js/admin.js', 'text/javascript');
$this->headScript()->appendFile('/layouts/admin/js/core-block-grid-widget.js', 'text/javascript');
$this->headScript()->appendFile('/layouts/admin/js/application-admin-messenger.js', 'text/javascript');
$this->headScript()->appendFile('/layouts/admin/js/core-block-toolbar-widget.js', 'text/javascript');
$this->headScript()->appendFile('/layouts/admin/js/core-block-form-widget.js', 'text/javascript');
$this->headScript()->appendFile('/lib/tinymce/plugins/filemanager/js/mcfilemanager.js', 'text/javascript');
$this->headScript()->appendFile('/lib/tinymce/plugins/imagemanager/js/mcimagemanager.js', 'text/javascript');

echo $this->headScript();

?>
<script type="text/javascript">
var tinyMCECustomOptions = {
        // General options
        mode : "specific_textareas",
		editor_selector : 'mce',
        
        theme : "advanced",
        plugins : "imagemanager,filemanager,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
        extended_valid_elements : "iframe[align|allowtransparency|frameborder|height|hspace|marginheight|marginwidth|name|sandbox|scrolling|seamless|src|srcdoc|vspace|width]",
        
        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,charmap,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,sub,sup,visualchars,nonbreaking,pagebreak",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : false,
        force_br_newlines: true,
        //force_p_newlines: false,
        forced_root_block : '', // Needed for 3.x

        document_base_url : '/',
        remove_script_host : true,
        relative_urls : false,
        //convert_urls : false,
        
        width : "100%",
        
        // Example content CSS (should be your site CSS)
        content_css : "/layouts/admin/css/editor.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
};
</script>
<script type="text/javascript">
tinyMCE_GZ.init(tinyMCECustomOptions);
</script>
<script type="text/javascript">
tinyMCE.init(tinyMCECustomOptions);
</script>
