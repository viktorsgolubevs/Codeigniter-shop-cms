    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('product');?><span><?=lang('product-view');?> - <?=$product_data['name'];?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header">
                    <ul>
                        <li><a href="<?=site_url('back_end/product_list');?>"><?=lang('product-list');?></a></li>
                        <li class="active"><?=lang('product-view');?></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="content_body">
                    <?=form_open(uri_string()); ?>
    
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-name');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'product_name', 'value' => $product_data['name'], 'class' => 'form_control sz1', 'disabled' => 'disabled'))?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('code');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'product_code', 'value' => strtoupper($product_data['product_code']), 'class' => 'form_control sz3', 'disabled' => 'disabled'))?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-category');?>:</span></div>
                                <div class="input_block">
                                    <select name="product_category" class="form_control sz1 chosen-select-deselect" data-placeholder="Choose a category">
                                        <option value="<?=$product_data['product_category_id'];?>"><?=$product_data['category_name'];?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-description');?>:</span></div>
                                <div class="input_block">
                                    <?=form_textarea(array('name' => 'product_description', 'value' => strip_tags($product_data['description']), 'class' => 'form_control sz1', 'rows' => 4, 'cols' => 40, 'disabled' => 'disabled'));?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-quantity');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'product_quantity', 'value' => $product_data['quantity'], 'class' => 'form_control sz3', 'disabled' => 'disabled'))?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-price-without-vat');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'product_price_without_vat', 'value' => get_price_without_tax($product_data['price']), 'class' => 'form_control with-label sz4', 'disabled' => 'disabled'))?>
                                    <div class="input_name"> <?=get_currency_name($this->config->item('default_currency'));?> </div>
                                </div>
                            </div>
                            
                            <div class="input_separator"></div>
                            
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-price-with-vat');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'product_price_with_vat', 'value' => format_price($product_data['price']), 'class' => 'form_control with-label sz4', 'disabled' => 'disabled'))?>
                                    <div class="input_name"> <?=get_currency_name($this->config->item('default_currency'));?> </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label><?=lang('product-option');?>:</label></span></div>
                                <div class="input_block">
                                    <? if ($product_data['options_available']) : ?>
                                    <?=form_checkbox(array('name' => 'product_options_available', 'value' => 1, 'checked' => 'checked', 'class' => 'checkbox-inline', 'disabled' => 'disabled'));?>
                                    <? else : ?>
                                    <?=form_checkbox(array('name' => 'product_options_available', 'value' => 0, 'class' => 'checkbox-inline', 'disabled' => 'disabled'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label><?=lang('product-sale');?>:</label></span></div>
                                <div class="input_block">
                                    <? if ($product_data['options']=='sale') : ?>
                                    <?=form_radio(array('name' => 'product_options', 'value' => 'sale', 'class' => 'checkbox-inline', 'checked' => 'checked', 'disabled' => 'disabled'));?>
                                    <? else : ?>
                                    <?=form_radio(array('name' => 'product_options', 'value' => 'sale', 'class' => 'checkbox-inline', 'disabled' => 'disabled'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                            
                            <div class="input_group <? if ($product_data['options'] != 'sale') : ?>hide<? endif; ?>" id="sale_price_block">
                                <div class="block">
                                    <div class="control-label"><span><?=lang('product-sale-price');?>:</span></div>
                                    <div class="input_block">
                                        <?=form_input(array('name' => 'product_sale_price', 'value' => format_price($product_data['sale_price']), 'class' => 'form_control with-label sz4', 'disabled' => 'disabled'))?>
                                        <div class="input_name"> <?=get_currency_name($this->config->item('default_currency'));?> </div>
                                        <div class="field-description">( <?=lang('product-with-vat');?> )</div>
                                        <div class="clear"></div>
                                        <?=form_error('product_sale_price','<div class="field_error">','<span>X</span></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="input_separator"></div>
                            
                            <div class="block">
                                <div class="control-label"><span><label><?=lang('product-new');?>:</label></span></div>
                                <div class="input_block">
                                    <? if ($product_data['options']=='new') : ?>
                                    <?=form_radio(array('name' => 'product_options', 'value' => 'new', 'class' => 'checkbox-inline', 'checked' => 'checked', 'disabled' => 'disabled'));?>
                                    <? else : ?>
                                    <?=form_radio(array('name' => 'product_options', 'value' => 'new', 'class' => 'checkbox-inline', 'disabled' => 'disabled'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                            
                            <div class="input_separator"></div>
                            
                            <div class="block">
                                <div class="control-label"><span><label><?=lang('product-hot');?>:</label></span></div>
                                <div class="input_block">
                                    <? if ($product_data['options']=='hot') : ?>
                                    <?=form_radio(array('name' => 'product_options', 'value' => 'hot', 'class' => 'checkbox-inline', 'checked' => 'checked', 'disabled' => 'disabled'));?>
                                    <? else : ?>
                                    <?=form_radio(array('name' => 'product_options', 'value' => 'hot', 'class' => 'checkbox-inline', 'disabled' => 'disabled'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-video');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'youtube_link', 'value' => $product_data['youtube_link'], 'class' => 'form_control with-label sz2', 'disabled' => 'disabled'))?>
                                    <div class="input_name"><?=lang('product-youtube-link');?></div>
                                </div>
                            </div>
                        </div>
    
                        <? if(!empty($product_data['image'])) : ?>
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('product-image');?>:</span></div>
                                <div class="product_image_block">
                                    <div class="img_block">
                                        <div class="highslide-gallery">
                                            <a href="<?=base_url($this->config->item('image_big').$product_data['image']);?>" class="highslide" onclick="return hs.expand(this)">
                                                <img src="<?=site_url($this->config->item('trumb1_location').$product_data['image']);?>" alt="" title="<?=lang('enlarge-image');?>"/>
                                            </a>                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <? endif; ?>
    
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('meta-tags');?>:</span></div>
                                <div class="input_block">
                                    <input type="hidden" name="meta_tags" id="meta_tags" value="<?=$product_data['meta_tags'];?>" class="form_control sz4">
                                    <ul id="singleFieldTags"></ul>
                                </div>
                            </div>
                        </div>
    
                       <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label><?=lang('active');?>:</label></span></div>
                                <div class="input_block">
                                    <? if ($product_data['active']) : ?>
                                    <?=form_checkbox(array('name' => 'product_active', 'value' => 1, 'checked' => 'checked', 'class' => 'checkbox-inline', 'disabled' => 'disabled'));?>
                                    <? else: ?>
                                    <?=form_checkbox(array('name' => 'product_active', 'value' => 0, 'class' => 'checkbox-inline', 'disabled' => 'disabled'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
    
                        <div class="clear"></div>
                        
                        <div class="footer-button-group-container">
                            <div class="button-group-block">
                                <div class="button-position">
                                    <a href="<?=site_url('back_end/product_list');?>" class="btn btn-gray"><?=lang('back');?></a>
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