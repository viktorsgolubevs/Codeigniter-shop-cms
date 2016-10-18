<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    
    <link href="<?=site_url($this->config->item('css_front_end') . 'style.css');?>" rel="stylesheet" type="text/css" />
 
    <script src="<?=site_url($this->config->item('js_global') . 'jquery-1.11.0.min.js');?>"></script>
    <script src="<?=site_url($this->config->item('js_front_end') . 'jquery.mixitup.min.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_front_end') . 'front_js.js');?>"></script>
    
    <script type="text/javascript">
    		
		$(function(){
			$('#product').mixitup();
		});
        
    </script>
        
    <!--[if lt IE 9]>
    			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
 
	<title>Shop</title>
</head>
<body>
<div id="modal-box-bg"></div>