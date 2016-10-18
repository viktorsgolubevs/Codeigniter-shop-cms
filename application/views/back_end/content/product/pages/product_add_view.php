    <div id="category-dialog-form" class="modal-block" title="<?=lang('category-add');?>">
        <?=form_open(); ?>
            <div class="input_group">
                <div class="block">
                    <div class="control-label"><span><?=lang('category-name');?>:</span></div>
                    <div class="input_block">
                        <?=form_input(array('name' => 'category_name', 'value' => set_value('category_name'), 'class' => 'form_control sz1'))?>
                    </div>
                </div>
            </div>
            
            <div class="clear"></div>
            
            <div class="footer-button-group-container">
                <div class="button-group-block">
                    <div class="button-position">
                        <input type="button" id="add_category" name="add_category" value="<?=lang('add');?>" class="btn btn-blue" />
                    </div>
                </div>
            </div>
        <?=form_close();?>
    </div>
    
    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('product');?><span><?=lang('product-add');?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header">
                    <ul>
                        <li><a href="<?=site_url('back_end/product_list');?>"><?=lang('product-list');?></a></li>
                        <li class="active"><?=lang('product-add');?></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="content_body">
                    <?=form_open_multipart(uri_string()); ?>
    
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-name');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'product_name', 'value' => set_value('product_name'), 'class' => 'form_control sz1'))?>
                                    <?=form_error('product_name','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('code');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'product_code', 'value' => set_value('product_code'), 'class' => 'form_control sz3'))?>
                                    <?=form_error('product_code','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-category');?>:</span></div>
                                <div class="input_block">
                                    <div class="left_field">
                                        <select name="product_category" id="product_category" class="form_control sz1 chosen-select-deselect" data-placeholder="<?=lang('product-category-choose');?>">
                                            <option value=""></option>
                                            <? foreach ($product_categories as $value) : ?>
                                            <option value="<?=$value['idCategory'];?>" <?=set_select('product_category', $value['idCategory']); ?>><?=$value['name'];?></option>
                                            <? endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="right_btn">
                                        <input type="button" id="open_category_modal" class="btn btn-blue" value="+"/>
                                    </div>
                                    <div class="clear"></div>
                                    <?=form_error('product_category','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-description');?>:</span></div>
                                <div class="input_block">
                                    <?=form_textarea(array('name' => 'product_description', 'value' => set_value('product_description'), 'class' => 'form_control sz1 mce_editor', 'rows' => 4, 'cols' => 40));?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-quantity');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'product_quantity', 'value' => set_value('product_quantity'), 'class' => 'form_control sz3'))?>
                                    <?=form_error('product_quantity','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-price-without-vat');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'product_price_without_vat', 'value' => set_value('product_price_without_vat'), 'class' => 'form_control with-label sz4', 'id' => 'price_without_vat'))?>
                                    <div class="input_name"> <?=get_currency_name($this->config->item('default_currency'));?> </div>
                                    <div class="clear"></div>
                                    <?=form_error('product_price_without_vat','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                            
                            <div class="input_separator"></div>
                            
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-price-with-vat');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'product_price_with_vat', 'value' => set_value('product_price_with_vat'), 'class' => 'form_control with-label sz4', 'id' => 'price_with_vat'))?>
                                    <div class="input_name"> <?=get_currency_name($this->config->item('default_currency'));?> </div>
                                    <div class="clear"></div>
                                    <?=form_error('product_price_with_vat','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label for="product_options"><?=lang('product-option');?>:</label></span></div>
                                <div class="input_block">
                                    <?=form_checkbox(array('name' => 'product_options_available', 'value' => true, 'checked' => set_checkbox('product_options_available', true, true), 'class' => 'checkbox-inline', 'id' => 'product_options'));?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label for="sale"><?=lang('product-sale');?>:</label></span></div>
                                <div class="input_block">
                                    <?=form_radio(array('name' => 'product_options', 'value' => 'sale', 'class' => 'checkbox-inline', 'checked' => set_radio('product_options', 'sale'), 'id' => 'sale'));?>
                                </div>
                            </div>
                            
                            <div class="input_group" id="sale_price_block">
                                <div class="block">
                                    <div class="control-label"><span><?=lang('product-sale-price');?>:</span></div>
                                    <div class="input_block">
                                        <?=form_input(array('name' => 'product_sale_price', 'value' => set_value('product_sale_price'), 'class' => 'form_control with-label sz4', 'id' => 'sale_price'))?>
                                        <div class="input_name"> <?=get_currency_name($this->config->item('default_currency'));?> </div>
                                        <div class="field-description">( <?=lang('product-with-vat');?> )</div>
                                        <div class="clear"></div>
                                        <?=form_error('product_sale_price','<div class="field_error">','<span>X</span></div>'); ?>
                                    </div>
                                </div>
                            </div>
    
                            <div class="input_separator"></div>
                            
                            <div class="block">
                                <div class="control-label"><span><label for="new"><?=lang('product-new');?>:</label></span></div>
                                <div class="input_block">
                                    <?=form_radio(array('name' => 'product_options', 'value' => 'new', 'class' => 'checkbox-inline', 'checked' => set_radio('product_options', 'new'), 'id' => 'new'));?>
                                </div>
                            </div>
                            
                            <div class="input_separator"></div>
                            
                            <div class="block">
                                <div class="control-label"><span><label for="hot"><?=lang('product-hot');?>:</label></span></div>
                                <div class="input_block">
                                    <?=form_radio(array('name' => 'product_options', 'value' => 'hot', 'class' => 'checkbox-inline', 'checked' => set_radio('product_options', 'hot'), 'id' => 'hot'));?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-video');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'youtube_link', 'value' => set_value('youtube_link'), 'class' => 'form_control with-label sz2'))?>
                                    <div class="input_name"><?=lang('product-youtube-link');?></div>
                                </div>
                            </div>
                        </div>
    
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-image-upload');?>:</span></div>
                                <div class="input_block vertical_align_table">
                                    <div class="input_upload_block vertical_align_table_cell">
                                        <?=form_upload(array('name' => 'file', 'class' => 'input_file_block sz1', 'id' => 'imgInp'));?>
                                        <? if($this->session->flashdata('image_error')):?><?=$this->session->flashdata('image_error');?><? endif;?>
                                    </div>
                                    <div class="upload_img highslide-gallery" id="img_preview"></div>
                                </div>
                            </div>
                            
                            <div class="input_separator"></div>
                            
                            <div class="block">
                                <div class="control-label"> &nbsp; </div>
                                <div class="input_block">
                                    <?=form_checkbox(array('name' => 'simple_image_upload', 'class' => 'checkbox-inline', 'id' => 'simple_upload'));?>
                                    <label for="simple_upload"><?=lang('product-simple-image-upload');?></label>
                                </div>
                            </div>
                        </div>
    
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('meta-tags');?>:</span></div>
                                <div class="input_block">
                                    <input type="hidden" name="meta_tags" id="meta_tags" value="<?=set_value('meta_tags');?>" class="form_control sz4">
                                    <ul id="singleFieldTags"></ul>
                                    <?=form_error('meta_tags','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
    
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label for="product_active"><?=lang('active');?>:</label></span></div>
                                <div class="input_block">
                                    <?=form_checkbox(array('name' => 'product_active', 'value' => true, 'checked' => set_checkbox('product_active', true, true), 'class' => 'checkbox-inline', 'id' => 'product_active'));?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="footer-button-group-container">
                            <div class="button-group-block">
                                <div class="button-position">
                                    <?=form_submit(array('name' => 'add_product', 'value' => lang('add'), 'class' => 'btn btn-blue'));?>
                                </div>
                            </div>
                        </div>
                        
                    <?=form_close();?>
                </div>
            </div>
        </div>
    </div>

</div> <!-- Page wrapper end -->

<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'}
    }
    
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
</script>

</body>
</html>