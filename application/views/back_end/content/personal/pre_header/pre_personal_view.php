<html>
<head>
    <title>Shop</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <link href="<?=site_url($this->config->item('css_folder') . 'jquery-ui-1.8.4.custom.css');?>" rel="stylesheet" type="text/css" />

    <link href="<?=site_url($this->config->item('css_back_end') . 'admin_style.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=site_url($this->config->item('css_back_end') . 'select/chosen.css');?>" rel="stylesheet" type="text/css" />
    
    <link href="<?=site_url($this->config->item('css_back_end') . 'tagit/jquery.tagit.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=site_url($this->config->item('css_back_end') . 'tagit/tagit.ui-zendesk.css');?>" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_global') . 'jquery-1.11.0.min.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_global') . 'jquery-ui-1.9.2.min.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'jquery.dataTables.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'column_filter.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/fixture.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/highlight.pack.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/jquery.cookie.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/jquery.navgoco.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'select/chosen.jquery.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'admin_general.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'tagit/tag-it.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_folder') . 'highslide/highslide-with-gallery.js');?>"></script>
	
    <script type="text/javascript" charset="utf-8">
        
		$(document).ready(function() {
            
			oTable = $('#personal_list').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",

				"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
				"iDisplayLength": <?=$this->config->item('admin_show_per_page');?>,

                "aoColumnDefs": [{ "bSortable": false, "aTargets": [ 2,3,5 ] }],
                "aaSorting": []
			    
			}).columnFilter({
                aoColumns: [
                            { type: "text" },
                            { type: "text" },
                            null,
                            null,
                            { type: "text" }
                        ]
            });
            
			oTable = $('#unactivated_users_list').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",

				"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
				"iDisplayLength": <?=$this->config->item('admin_show_per_page');?>,

                "aoColumnDefs": [{ "bSortable": false, "aTargets": [ 0 ] }],
                "aaSorting": []
			    
			}).columnFilter({
                aoColumns: [
                            null,
                            { type: "text" },
                            { type: "text" },
                            { type: "text" },
                            { type: "text" },
                            { type: "text" }
                        ]
            });
            
		});
        
        
	</script>

</head>
<body>