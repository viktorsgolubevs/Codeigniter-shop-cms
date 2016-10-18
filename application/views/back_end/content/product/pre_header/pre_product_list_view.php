<html>
<head>
	<title>Shop</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    
    <link href="<?=site_url($this->config->item('css_folder') . 'jquery-ui-1.8.4.custom.css');?>" rel="stylesheet" type="text/css" />
    
    <link href="<?=site_url($this->config->item('css_back_end') . 'admin_style.css');?>" rel="stylesheet" type="text/css" />
    
    <link href="<?=site_url($this->config->item('css_folder') . 'highslide.css');?>" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_global') . 'jquery-1.11.0.min.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'jquery.dataTables.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'column_filter.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/fixture.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/highlight.pack.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/jquery.cookie.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/jquery.navgoco.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'admin_general.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_global') . 'highslide/highslide-with-gallery.js');?>"></script>

	<script type="text/javascript" charset="utf-8">
        
		$(document).ready(function() {
          
			oTable = $('#product_list').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",

				"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
				"iDisplayLength": <?=$this->config->item('admin_show_per_page');?>,

				"oLanguage": {
                    "sLengthMenu": "Radit _MENU_ records per page",
                    "sZeroRecords": "Nothing found - sorry",
                    "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    "sInfoEmpty": "Showing 0 to 0 of 0 records",
                    "sInfoFiltered": "(filtered from _MAX_ total records)"
                },
                "aoColumnDefs": [{ "bSortable": false, "aTargets": [ 0,5,6 ] }],
                "aaSorting": []
			    
			}).columnFilter({
                aoColumns: [
                            null,
                            { type: "text" },
                            { type: "text" },
                            { type: "text" },
                            { type: "number" }
                            
                        ]
            });
		});
        
	</script>
    
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