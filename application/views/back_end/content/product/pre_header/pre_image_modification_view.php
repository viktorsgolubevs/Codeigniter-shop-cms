<html>
<head>
    <title>Shop</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    
    <link href="<?=site_url($this->config->item('css_back_end') . 'admin_style.css');?>" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_global') . 'jquery-1.11.0.min.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'admin_general.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/fixture.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/highlight.pack.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/jquery.cookie.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/jquery.navgoco.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'jquery-pack.js');?>"></script>
   	<script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'jquery.imgareaselect.min.js');?>"></script>
    
    <script type="text/javascript">
    function preview(img, selection) { 
    	var scaleX = <?=$this->config->item('trumb1_width');?> / selection.width; 
    	var scaleY = <?=$this->config->item('trumb1_height');?> / selection.height; 
    	
    	var scaleX2 = <?=$this->config->item('trumb2_width');?> / selection.width; 
    	var scaleY2 = <?=$this->config->item('trumb2_height');?> / selection.height;
    	
    	$('#trumb1 > img').css({ 
    		width: Math.round(scaleX * <?=$main_image_width;?>) + 'px', 
    		height: Math.round(scaleY * <?=$main_image_height;?>) + 'px',
    		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
    		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
    	});
    	
    	$('#trumb2 > img').css({ 
    		width: Math.round(scaleX2 * <?=$main_image_width;?>) + 'px', 
    		height: Math.round(scaleY2 * <?=$main_image_height;?>) + 'px',
    		marginLeft: '-' + Math.round(scaleX2 * selection.x1) + 'px', 
    		marginTop: '-' + Math.round(scaleY2 * selection.y1) + 'px' 
    	});
    	
    	$('#x1').val(selection.x1);
    	$('#y1').val(selection.y1);
    	$('#x2').val(selection.x2);
    	$('#y2').val(selection.y2);
    	$('#w').val(selection.width);
    	$('#h').val(selection.height);
    } 
    
    $(document).ready(function () { 
    	$('#save_thumb').click(function() {
    		var x1 = $('#x1').val();
    		var y1 = $('#y1').val();
    		var x2 = $('#x2').val();
    		var y2 = $('#y2').val();
    		var w = $('#w').val();
    		var h = $('#h').val();
    		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
    			alert("You must make a selection first");
    			return false;
    		}else{
    			return true;
    		}
    	});
    }); 
    
    $(window).load(function () { 
    	$('#thumbnail').imgAreaSelect({ aspectRatio: '1:<?=$trumb_ratio;?>', onSelectChange: preview }); 
    });
    
    </script>
</head>
<body>