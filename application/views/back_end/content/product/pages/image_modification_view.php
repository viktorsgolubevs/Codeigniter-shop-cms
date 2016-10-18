    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <h2><?=lang('product');?><span><?=lang('product-image-modification');?></span></h2>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header"><span><?=lang('product-image-modification');?></span></div>
                <div class="content_body">
                
        			<img src="<?=site_url($image_url);?>" style="float: left;" id="thumbnail" alt="Create Thumbnail" />
        			
        			<div id="trumb1" style="border:1px #e5e5e5 solid; float:left; position:relative; margin-left: 1%; margin-top: 1%; overflow:hidden; width:<?=$this->config->item('trumb1_width');?>px; height:<?=$this->config->item('trumb1_height');?>px;">
        				<img src="<?=site_url($image_url);?>" style="position: relative;" alt="Thumbnail Preview" />
        			</div>
        			
        			<div id="trumb2" style="border:1px #e5e5e5 solid; float:left; position:relative; margin-left: 1%; margin-top: 1%; overflow:hidden; width:<?=$this->config->item('trumb2_width');?>px; height:<?=$this->config->item('trumb2_height');?>px;">
        				<img src="<?=site_url($image_url);?>" style="position: relative;" alt="Thumbnail Preview" />
        			</div>
        			
        			<br style="clear:both;"/>
                    
                    <?=form_open('back_end/upload_trumbnail'); ?>
                    
        				<input type="hidden" name="x1" value="" id="x1" />
        				<input type="hidden" name="y1" value="" id="y1" />
        				<input type="hidden" name="x2" value="" id="x2" />
        				<input type="hidden" name="y2" value="" id="y2" />
        				<input type="hidden" name="w" value="" id="w" />
        				<input type="hidden" name="h" value="" id="h" />
                        
                        <div class="footer-button-group-container">
                            <div class="button-group-block">
                            
                                <?=form_submit(array('name' => 'upload_thumbnail', 'value' => lang('product-save-trumb-img'), 'class' => 'btn btn-blue', 'id' => 'save_thumb')); ?>
                                
                            </div>
                        </div>
                        
        			<?=form_close(); ?>
            		
                </div>
            </div>
        </div>
    </div>

</div> <!-- Page wrapper end -->

</body>
</html>