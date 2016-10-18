    <script>
        var csrf_name = '<?=$this->security->get_csrf_token_name(); ?>';
        var csrf_token = '<?=$this->security->get_csrf_hash(); ?>';
    </script>
    
    <div class="wrap_bg">
        
        <div id="youtube-window"></div>
        
        <div class="main_container">
            
            <div class="product_show">
                <div class="product_image highslide-gallery">
                    <? if(!empty($product_item['image'])) : ?>
                    <a href="<?=base_url($this->config->item('image_big').$product_item['image']);?>" class="highslide" onclick="return hs.expand(this)">
                        <img src="<?=site_url($this->config->item('trumb1_location') . $product_item['image']);?>" alt="" title="<?=lang('product-enlarge-photo');?>" />
                    </a>
                    <? else : ?>
                    <img src="<?=site_url($this->config->item('trumb1_location') . 'empty_270.jpg');?>" alt="" title="" />
                    <? endif; ?>
                    
                    <? if (!empty($product_item['youtube_link'])) : ?>
                    <div class="video-btn-preview-block">
                        <div class="video-button" data-video="<?=show_youtube($product_item['youtube_link']);?>"><?=lang('product-label-video');?></div>
                    </div>
                    <? endif; ?>
                </div>
                <div class="product_info">
                    <h1><?=$product_item['name'];?></h1>
                    <div class="price_block">
                        <? if ($product_item['sale_price'] && $product_item['options_available'] && $product_item['options'] === 'sale') : ?>
                        <div class="product_discount_price left">
                            <?=get_currency_name($this->config->item('default_currency'));?>
                            <span class="price"><?=format_price($product_item['price']);?></span>
                        </div>
                        <div class="product_price">
                            <?=get_currency_name($this->config->item('default_currency'));?>
                            <span class="price"><?=format_price($product_item['sale_price']);?></span>
                        </div>
                        <div class="product_price_save">( <?=lang('product-label-sale-save');?>: <?=get_currency_name($this->config->item('default_currency'));?> <?=format_price($product_item['price'] - $product_item['sale_price']);?> )</div>
                        
                        <? else : ?>
                        <div class="product_price">
                            <?=get_currency_name($this->config->item('default_currency'));?>
                            <span class="price">
                                <?=format_price($product_item['price']);?>
                            </span>
                        </div>                        
                        <? endif; ?>
                    </div>
                    
                    <? if(!empty($product_item['product_code'])) : ?>
                    <div class="product_code"><span><?=lang('product-code');?>:</span><?=$product_item['product_code'];?></div>
                    <? endif; ?>
                    
                    <? if (!empty($quantity_items)) : ?>
                    
                        <div class="product_form_wrap">
                        
                            <? if (config_item('catalog_mode')) : ?>
                            <div class="quantity_label"><?=lang('product-quantity');?>: <?=count($quantity_items);?></div>
                            <? else : ?>
                        
                            <?=form_open(site_url('add_to_cart')); ?>
                                <div class="quantity_label left"><?=lang('product-quantity');?>:</div>
                                
                                <div class="quantity_block left">
                                    <select name="quantity" class="chosen-select-deselect" data-placeholder=" ">>
                                        <option></option>
                                        <? foreach($quantity_items as $value) : ?>
                                        <option value="<?=$value;?>"><?=$value;?></option>
                                        <? endforeach; ?>
                                    </select>
                                </div>
    
                                <?=form_submit(array('name' => 'submit', 'value' => lang('product-btn-add-to-cart'), 'id' => 'btn_product_buy', 'class' => 'form-sub non-active'));?>
    
                                <input type="hidden" value="<?=$product_item['idProduct'];?>" name="product"/>
                            <?=form_close();?>
                        
                        <? endif; ?>
                        </div>
                        
                    <? else : ?>
                    
                    <div class="product_not_available"><?=lang('product-no-available');?></div>
                    
                    <? endif; ?>
                    
                    <? if (!empty($product_item['description'])) : ?>                    
                    <div class="product_description_block">
                        <?=lang('product-description');?>:
                        <div class="description_text_block">
                            <p><?=$product_item['description'];?></p>
                        </div>
                    </div>
                    <? endif; ?>
                    
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        
        $("select[name='quantity']").chosen({
            allow_single_deselect:true,
            disable_search: true
        });
        
    </script>