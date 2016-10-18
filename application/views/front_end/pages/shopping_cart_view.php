    <? if ($this->session->flashdata('cart_error')) : ?>
    <div class="cart_error_block"><?=$this->session->flashdata('cart_error');?></div>
    <? endif; ?>
    
    <div class="wrap_bg">
        <div class="main_container">
        
        <? if(isset($empty_cart)) : ?>
        
        <div class="attention_block">
            <div class="img_icon">
                <img src="<?=site_url($this->config->item('img_folder') . 'stock-icon.png');?>" alt="empty_cart">
            </div>
            <h1><?=lang('cart-empty-desc');?></h1>
            <h4><?=$this->lang->line('cart-empty-link', '<a href="'.base_url().'">', '</a>');?></h4>
        </div>
        
        <? else : ?>
        
            <h2><?=lang('cart');?></h2>
            <div class="cart_block">
            <h4 class="section"><?=lang('cart-desc-label');?></h4>
                <?=form_open(base_url('front_end_cart/update_total')); ?>
                    <table class="cart_content">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th class="left"><?=lang('product-quantity');?></th>
                                <th class="currency right"><?=lang('product-price');?></th>
                                <th class="currency right"><?=lang('product-tax');?></th>
                                <th class="currency right"><?=lang('product-price_total');?></th>
                                <th class="last"></th>
                            </tr>
                        </thead>
                        <? foreach($cart_list as $value) : ?>
                        <input type="hidden" value= "<?=$value['rowid'];?>" name="rowid[]" />
                        <tbody>
                            
                            <? if ($this->session->flashdata('cart_row_error')) : ?>
                                <? if (in_array($value['idProduct'], $this->session->flashdata('cart_row_error'))) : ?>
                                    <tr class="cart_error_row">
                                <? endif; ?>
                            <? else : ?>
                            <tr>
                            <? endif; ?>
                                <td class="thumbnail">
                                    <? if (!empty($value['image'])) : ?>
                                    <a href="<?=base_url('product/'.$value['idProduct']);?>" title="<?=$value['name'];?>">
                                        <img src="<?=site_url($this->config->item('trumb2_location') . $value['image']);?>" alt=""/>
                                    </a>
                                    <? else : ?>
                                    <img src="<?=site_url($this->config->item('trumb2_location') . 'empty_75.jpg');?>" alt=""/>
                                    <? endif; ?>
                                </td>
                                <td class="item_info"><h5><?=$value['name'];?></h5></td>
                                <td class="left"><input type="text" name="quantity[]" value="<?=$value['quantity'];?>" maxlength="3" class="item_qty" /></td>
                                <td class="right"><nobr><span class="currency_sign"><?=get_currency_name($this->config->item('default_currency'));?></span>&nbsp;<?=format_price($value['price']);?></nobr></td>
                                <td class="right"><nobr><span class="currency_sign"><?=get_currency_name($this->config->item('default_currency'));?></span>&nbsp;<?=get_price_tax_back($value['price']);?></nobr></td>
                                <td class="right"><nobr><span class="currency_sign"><?=get_currency_name($this->config->item('default_currency'));?></span>&nbsp;<?=format_price($value['subtotal']);?></nobr></td>
                                <td class="remove"><a href="<?=base_url('front_end_cart/remove_item/'.$value['rowid']);?>" class="remove_btn"><?=lang('cart-remove-item');?></a></td>
                            </tr>                        
                        </tbody>
                        <? endforeach; ?>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                <? if ($this->config->item('coupon_active')) : ?>
                                
                                    <?=form_input(array('name' => 'coupon_code', 'value' => isset($coupon_code) ? $coupon_code : '')); ?>
                                    <?=form_submit(array('name' => 'code_check', 'value' => lang('cart-use-coupon'), 'class' => 'checkout')); ?>
                                    
                                    <? if ($this->session_lib->is_coupon_data()) : ?><br /> <a href="<?=site_url('empty_coupon');?>" class="empty_coupon"><?=lang('cart-delete-coupon');?></a><? endif; ?>
                                <? endif; ?>
                                </td>
                                <td colspan="3" class="total_sum_label right"><?=lang('product-price-total');?>:</td>
                                <? if(isset($cart_discount) && $cart_discount) : ?>
                                <td class="currency  right"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<span class="without_discount_sum"><?=format_price($this->cart->total());?></span> <span class="discount_sum"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($discount_price);?></span></td>
                                <? else : ?>
                                <td class="currency total_sum right"><nobr><span class="currency_sign"><?=get_currency_name($this->config->item('default_currency'));?></span>&nbsp;<span class="discount_sum"><?=format_price($this->cart->total());?></span></nobr></td>
                                <? endif; ?>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="ch_button">
                        <a href="<?=site_url('empty_cart');?>" class="empty_cart"><?=lang('cart-empty');?></a>
                        
                        <?=form_submit(array('name' => 'update_total', 'value' => lang('cart-update'), 'class' => 'update_total')); ?>
                        
                        <a href="<?=site_url('checkout');?>" class="checkout"><?=lang('cart-checkout');?></a>
                    </div>
                <?=form_close(); ?>
            </div>
            
        <? endif; ?>  
            
        </div>    
    </div>