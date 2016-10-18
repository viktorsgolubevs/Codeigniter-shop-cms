<html>
<head>
    <title>Shop</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <link href="<?=site_url($this->config->item('css_folder') . 'jquery-ui-1.8.4.custom.css');?>" rel="stylesheet" type="text/css" />
    
    <link href="<?=site_url($this->config->item('css_back_end') . 'admin_style.css');?>" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_global') . 'jquery-1.11.0.min.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'jquery.dataTables.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'column_filter.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/fixture.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/highlight.pack.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/jquery.cookie.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/jquery.navgoco.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'admin_general.js');?>"></script>
    
	<script type="text/javascript" charset="utf-8">
        
			$(document).ready(function() {
				oTable = $('#category_list').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers",
	
    				"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    				"iDisplayLength": <?=$this->config->item('admin_show_per_page');?>,

                    "aoColumnDefs": [{ "bSortable": false, "aTargets": [ 3 ] }],
                    "aaSorting": []
				    
				}).columnFilter({
                    aoColumns: [
                                { type: "text" },
                                { type: "text" }
                            ]
                });
			});
        
        
	</script>
</head>
<body>