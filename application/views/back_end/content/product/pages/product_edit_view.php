    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('product');?><span><?=lang('product-edit');?> - <?=$product_edit['name'];?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header">
                    <ul>
                        <li><a href="<?=site_url('back_end/product_list');?>"><?=lang('product-list');?></a></li>
                        <li class="active"><?=lang('product-edit');?></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="content_body">
                    <?=form_open_multipart(uri_string()); ?>
    
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-name');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'product_name', 'value' => $product_edit['name'], 'class' => 'form_control sz1'))?>
                                    <?=form_error('product_name','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('code');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'product_code', 'value' => $product_edit['product_code'], 'class' => 'form_control sz3'))?>
                                    <?=form_error('product_code','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-category');?>:</span></div>
                                <div class="input_block">
                                    <select name="product_category" class="form_control sz1 chosen-select-deselect" data-placeholder="<?=lang('product-category-choose');?>">
                                        <? foreach ($product_categories as $value) : ?>
                                        <? if ($value['idCategory'] == $product_edit['product_category_id']) : ?>
                                        <option value="<?=$value['idCategory'];?>" selected="selected"><?=$value['name'];?></option>
                                        <? else : ?>
                                        <option value="<?=$value['idCategory'];?>"><?=$value['name'];?></option>
                                        <? endif; ?>
                                        <? endforeach; ?>
                                    </select>
                                    <?=form_error('product_category','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-description');?>:</span></div>
                                <div class="input_block">
                                    <?=form_textarea(array('name' => 'product_description', 'value' => $product_edit['description'], 'class' => 'form_control sz1 mce_editor', 'rows' => 4, 'cols' => 40));?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-quantity');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'product_quantity', 'value' => $product_edit['quantity'], 'class' => 'form_control sz3'))?>
                                    <?=form_error('product_quantity','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-price-without-vat');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'product_price_without_vat', 'value' => get_price_without_tax($product_edit['price']), 'class' => 'form_control with-label sz4', 'id' => 'price_without_vat'))?>
                                    <div class="input_name"> <?=get_currency_name($this->config->item('default_currency'));?> </div>
                                    <div class="clear"></div>
                                    <?=form_error('product_price_without_vat','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                            
                            <div class="input_separator"></div>
                            
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-price-with-vat');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'product_price_with_vat', 'value' => format_price($product_edit['price']), 'class' => 'form_control with-label sz4', 'id' => 'price_with_vat'))?>
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
                                    <? if ($product_edit['options_available']) : ?>
                                    <?=form_checkbox(array('name' => 'product_options_available', 'value' => 1, 'checked' => 'checked', 'class' => 'checkbox-inline', 'id' => 'product_options'));?>
                                    <? else : ?>
                                    <?=form_checkbox(array('name' => 'product_options_available', 'value' => 0, 'class' => 'checkbox-inline', 'id' => 'product_options'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label for="sale"><?=lang('product-sale');?>:</label></span></div>
                                <div class="input_block">
                                    <? if ($product_edit['options']=='sale') : ?>
                                    <?=form_radio(array('name' => 'product_options', 'value' => 'sale', 'class' => 'checkbox-inline', 'checked' => 'checked', 'id' => 'sale'));?>
                                    <? else : ?>
                                    <?=form_radio(array('name' => 'product_options', 'value' => 'sale', 'class' => 'checkbox-inline', 'id' => 'sale'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                            
                            <div class="input_group <? if ($product_edit['options'] != 'sale') : ?>hide<? endif; ?>" id="sale_price_block">
                                <div class="block">
                                    <div class="control-label"><span><?=lang('product-sale-price');?>:</span></div>
                                    <div class="input_block">
                                        <?=form_input(array('name' => 'product_sale_price', 'value' => format_price($product_edit['sale_price']), 'class' => 'form_control with-label sz4', 'id' => 'sale_price'))?>
                                        <div class="input_name"> <?=get_currency_name($this->config->item('default_currency'));?></div>
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
                                    <? if ($product_edit['options']=='new') : ?>
                                    <?=form_radio(array('name' => 'product_options', 'value' => 'new', 'class' => 'checkbox-inline', 'checked' => 'checked', 'id' => 'new'));?>
                                    <? else : ?>
                                    <?=form_radio(array('name' => 'product_options', 'value' => 'new', 'class' => 'checkbox-inline', 'id' => 'new'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                            
                            <div class="input_separator"></div>
                            
                            <div class="block">
                                <div class="control-label"><span><label for="hot"><?=lang('product-hot');?>:</label></span></div>
                                <div class="input_block">
                                    <? if ($product_edit['options']=='hot') : ?>
                                    <?=form_radio(array('name' => 'product_options', 'value' => 'hot', 'class' => 'checkbox-inline', 'checked' => 'checked', 'id' => 'hot'));?>
                                    <? else : ?>
                                    <?=form_radio(array('name' => 'product_options', 'value' => 'hot', 'class' => 'checkbox-inline', 'id' => 'hot'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-video');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'youtube_link', 'value' => $product_edit['youtube_link'], 'class' => 'form_control with-label sz2'))?>
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
    
                        <? if(!empty($product_edit['image'])) : ?>
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-image');?>:</span></div>
                                <div class="product_image_block">
                                    <div class="img_block">
                                        <div class="highslide-gallery">
                                            <a href="<?=base_url($this->config->item('image_big').$product_edit['image']);?>" class="highslide" onclick="return hs.expand(this)">
                                                <img src="<?=site_url($this->config->item('trumb1_location').$product_edit['image']);?>" alt="" title="Click to enlarge"/>
                                            </a>                
                                        </div>
                                        <div class="img_block_option"><a href="<?=site_url('back_end/product_delete_image/'.$product_edit['idProduct'] .'/'. $product_edit['image']);?>">delete</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <? endif; ?>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('meta-tags');?>:</span></div>
                                <div class="input_block">
                                    <input type="hidden" name="meta_tags" id="meta_tags" value="<?=$product_edit['meta_tags'];?>" class="form_control sz4">
                                    <ul id="singleFieldTags"></ul>
                                    <?=form_error('meta_tags','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
    
                       <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label for="product_active"><?=lang('active');?>:</label></span></div>
                                <div class="input_block">
                                    <? if ($product_edit['active']) : ?>
                                    <?=form_checkbox(array('name' => 'product_active', 'value' => 1, 'checked' => 'checked', 'class' => 'checkbox-inline', 'id' => 'product_active'));?>
                                    <? else: ?>
                                    <?=form_checkbox(array('name' => 'product_active', 'value' => 0, 'class' => 'checkbox-inline', 'id' => 'product_active'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
    
                        <div class="clear"></div>
                        
                        <div class="footer-button-group-container">
                            <div class="button-group-block">
                                <div class="button-position">
                                    <?=form_submit(array('name' => 'edit_product', 'value' => lang('edit'), 'class' => 'btn btn-blue'));?>
                        
                                    <a href="<?=site_url('back_end/product_list');?>" class="btn btn-gray"><?=lang('reset');?></a>
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