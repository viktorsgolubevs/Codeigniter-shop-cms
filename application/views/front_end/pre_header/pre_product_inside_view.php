<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title><?=$product_item['name'];?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="<?=!empty($product_item['description']) ?  substr(strip_tags($product_item['description']),0,160) : $product_item['name'];?>" />
    <meta name="keywords" content="<?=$product_item['meta_tags'];?>" />
    
    <link href="<?=site_url($this->config->item('css_back_end') . 'select/chosen.css');?>" rel="stylesheet" type="text/css" />
    
    <link href="<?=site_url($this->config->item('css_front_end') . 'style.css');?>" rel="stylesheet" type="text/css" />
    
    <link href="<?=site_url($this->config->item('css_folder') . 'jquery-ui-1.8.4.custom.css');?>" rel="stylesheet" type="text/css" />
    
    <link href="<?=site_url($this->config->item('css_folder') . 'highslide.css');?>" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_global') . 'jquery-1.11.0.min.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_global') . 'jquery-ui-1.9.2.min.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_global') . 'jquery_easing.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_global') . 'highslide/highslide-with-gallery.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'select/chosen.jquery.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_front_end') . 'front_js.js');?>"></script>
    
    <script type="text/javascript">
        hs.graphicsDir = '<?=site_url($this->config->item('js_global'));?>/highslide/graphics/';
        hs.align = 'center';
        hs.transitions = ['expand', 'crossfade'];
        hs.outlineType = 'rounded-white';
        hs.fadeInOut = true;
        hs.addEventListener(document, 'click', function(e) {
           e = e || window.event;
           var target = e.target || e.srcElement;
        
           // if the target element is not within an expander but there is an expander on the page, close it
           if (!hs.getExpander(target) && hs.getExpander()) hs.close();
        });
        //hs.dimmingOpacity = 0.75;
        
        // Add the controlbar
        hs.addSlideshow({
        //slideshowGroup: 'group1',
        interval: 5000,
        repeat: false,
        useControls: true,
        fixedControls: 'fit',
        overlayOptions: {
        	opacity: 0.75,
        	position: 'bottom center',
        	hideOnMouseOut: true
        }
        });
    </script>
</head>
<body>
<div id="modal-box-bg"></div>