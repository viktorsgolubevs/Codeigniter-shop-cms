<html>
<head>
    <title>Shop</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <link href="<?=site_url($this->config->item('css_back_end') . 'admin_style.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=site_url($this->config->item('css_back_end') . 'select/chosen.css');?>" rel="stylesheet" type="text/css" />
    
    <link href="<?=site_url($this->config->item('css_folder') . 'jquery-ui-1.8.4.custom.css');?>" rel="stylesheet" type="text/css" />
    
    <link href="<?=site_url($this->config->item('css_back_end') . 'tagit/jquery.tagit.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=site_url($this->config->item('css_back_end') . 'tagit/tagit.ui-zendesk.css');?>" rel="stylesheet" type="text/css" />
    
    <link href="<?=site_url($this->config->item('css_folder') . 'highslide.css');?>" rel="stylesheet" type="text/css" />
            
    <script type="text/javascript" src="<?=site_url($this->config->item('js_global') . 'jquery-1.11.0.min.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_global') . 'jquery-ui-1.9.2.min.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/fixture.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/highlight.pack.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/jquery.cookie.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'menu/jquery.navgoco.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'select/chosen.jquery.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'admin_general.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'tinymce/tinymce.dev.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'tinymce/plugins/table/plugin.dev.js');?>"></script>
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'tinymce/plugins/paste/plugin.dev.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_back_end') . 'tagit/tag-it.js');?>"></script>
    
    <script type="text/javascript" src="<?=site_url($this->config->item('js_global') . 'highslide/highslide-with-gallery.js');?>"></script>
    
    <script>
    	tinymce.init({
            mode : "specific_textareas",
    		editor_selector: "mce_editor",
    		theme: "modern",
    		plugins: [
    			"advlist autolink link image lists charmap print preview hr anchor pagebreak",
    			"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
    			"contextmenu directionality paste textcolor importcss"
    		],
    
    		toolbar1: "newdocument fullpage | undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | formatselect fontselect fontsizeselect",
    		toolbar2: "cut copy paste pastetext | searchreplace | bullist numlist | outdent indent | link unlink image media code forecolor backcolor",
    		toolbar3: "hr removeformat | subscript superscript | charmap | print fullscreen | visualchars visualblocks | insertfile insertimage | insertdatetime preview",
    		menubar: false
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
    
    <script>
        $(document).ready(function(){
            
            //-------------------------------
            // Price
            //-------------------------------
            var vat = <?=$this->config->item('default_currency_vat');?>;
            
            function precise_round(num,decimals){
                return Math.round(num * Math.pow(10, decimals)) / Math.pow(10, decimals);
            }

            var regex = /^[0-9.,\b]+$/;
            
            $('#price_without_vat').keyup(function(e) {
                if (!regex.test($(this).val())) {
                    $(this).val('');
                } else {
                    if (e.keyCode === 188) {
                        $(this).val($(this).val().replace(/,/g,"."));
                    }
                
                    $('#price_with_vat').val(precise_round((+$(this).val()+($(this).val()*vat)/100),2).toFixed(2));
                }
            });
            
            $('#price_without_vat').bind('change',function () {
                if ($(this).val().length > 0) {
                    $(this).val(parseFloat($(this).val()).toFixed(2));
                }
            });
            
            $('#price_with_vat').keyup(function(e) {
                if (!regex.test($(this).val())) {
                    $(this).val('');
                } else {
                    if (e.keyCode === 188) {
                        $(this).val($(this).val().replace(/,/g,"."));
                    }
                
                    $('#price_without_vat').val(precise_round((($(this).val()/(vat+100))*100),2));
                }
            });
            
            $('#price_with_vat').bind('change',function () {
                if ($(this).val().length > 0) {
                    $(this).val(parseFloat($(this).val()).toFixed(2));
                }
            });
            
            $('#sale_price').keyup(function(e) {
                if (!regex.test($(this).val())) {
                    $(this).val('');
                } else {
                    if (e.keyCode === 188) {
                        $(this).val($(this).val().replace(/,/g,"."));
                    }
                }
            });
            
            $('#sale_price').bind('change',function () {
                if ($(this).val().length > 0) {
                    
                    $(this).val(parseFloat($(this).val()).toFixed(2));
                    
                    if (($('#price_with_vat').val() - $(this).val()) <= 0)
                    {
                        alert('Discount price can not be higher then sell price!');
                        
                        $(this).val('');
                    }
                }
            });
            
            //-------------------------------
            // TagIt
            //-------------------------------
            $('#meta_tags').tagit({
                singleField: true,
            });
            
            if($('#product_options').is(":checked")) {
                $('#product_options').closest(".input_group").addClass('option_bg');
                $('#product_options').closest(".input_group").next("div.input_group").addClass('option_bg').show();
            } else {
                $('#product_options').closest(".input_group").removeClass('option_bg');
                $('#product_options').closest(".input_group").next("div.input_group").removeClass('option_bg').hide();
            }
            
            //-------------------------------
            // Product sale options
            //-------------------------------
            $("#product_options").change(function(){
                if($(this).is(":checked")) {
                    $(this).closest(".input_group").addClass('option_bg');
                    $(this).closest(".input_group").next("div.input_group").addClass('option_bg').show();
                } else {
                    $(this).closest(".input_group").removeClass('option_bg');
                    $(this).closest(".input_group").next("div.input_group").removeClass('option_bg').hide();
                }
            });
            
            $('input[type=radio][name=product_options]').change(function(){
                if (this.value == 'sale') {
                    $('#sale_price_block').show();
                } else {
                    $('#sale_price_block').hide();
                }
            });
            
            //-------------------------------
            // Image hover - delete
            //-------------------------------
            $('.img_block').mouseenter(function(){
                $('.img_block_option a').show();
            }).mouseleave(function(){
                $('.img_block_option a').hide();
            });
            
            //-------------------------------
            // Category dialog - add
            //-------------------------------
            $("#category-dialog-form").dialog({
                autoOpen: false,
                width: 600,
                modal: true,
                resizable: false,
                closeOnEscape: true,   
                close: function() {
                    get_category_list();
                    
                    $('input[name="category_name"]').removeClass('form-error');
                }
            });
            
            $('#open_category_modal').click(function() {
                $('#category-dialog-form').dialog('open');
            });
            
            $('#add_category').click(function() {
                
                var link = '<?=site_url('back_end/category_add');?>';
                
                var category_name = $('input[name="category_name"]').val();
                
                var flag = false;
                
                // form field validation
                if (category_name.length > 0) {
                    flag = true;
                    $('input[name="category_name"]').removeClass('form-error');
                } else {
                    flag = false;
                    $('input[name="category_name"]').addClass('form-error');
                }
                
                if (flag) {
                    $.ajax({
                        type: "POST",
            			url: link,
            			data: $(this).closest('form').serialize(),
            			dataType: "json",
                        context: this,
            		  	success: function(data) {
                            if (data.status) {
                                $(this).closest('form')[0].reset();
                            } else {
                                alert('error');
                            }
            		 	},
                        error:function (xhr){
                            if (xhr.status == 401) {
                                //window.location.href = link;
                            }
                        }
            		});                    
                }
                
            });
            
            function get_category_list() {
            
                var link = '<?=site_url('back_end/category_list');?>';
                
                jQuery.ajax({
                	url: link,
                	dataType: "json",
                    context: this,
                  	success: function(data) {
                        if (data.content && data.content !== null) {
                        
                            if (jQuery.isArray(data.content)) {

                                var option = '<option value=""></option>';
                                
                                jQuery.each( data.content, function( key, value ) {
                                    option += '<option value="'+value.id+'">'+value.name+'</option>';
                                });
                                
                                $('#product_category').empty().append(option);
                                $('#product_category').trigger('chosen:updated');
                            }
                        } else {
                            alert('error');
                        }
                 	},
                    error:function (xhr){
                        if (xhr.status == 401) {
                            //window.location.href = link;
                        }
                    }
                });
            
            };
 
            $('.img_block_option a').click(function(event){
                event.preventDefault();
                
                var link = $(this).attr('href');
                
                jQuery.ajax({
                	url: link,
                	dataType: "json",
                    context: this,
                  	success: function(data) {
                        if (data.status) {
                            $(this).closest('.input_group').remove();
                        } else {
                            alert('error');
                        }
                 	},
                    error:function (xhr){
                        if (xhr.status == 401) {
                            //window.location.href = link;
                        }
                    }
                });
            });
        });
    </script>
    
</head>
<body>
