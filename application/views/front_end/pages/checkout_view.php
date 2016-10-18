    <div class="wrap_bg">
        <div class="main_container">
			
            <h2><?=lang('cart');?></h2>
			<div class="cart_block">
            
                <div class="tovar_list">
                    <table class="cart_content">
                        <thead>
                            <tr>
                                <td class="left"><?=lang('cart-checkout-item');?></td>
                                <td class="currency right"><?=lang('product-quantity');?></td>
                                <td class="currency right"><?=lang('product-price-total');?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach($cart_list as $value) : ?>
                            <tr>
                                <td class="item_info left"><h5><?=$value['name'];?></h5></td>
                                <td class="item_qty right"><?=$value['quantity'];?></td>
                                <td class="right"><span class="currency_sign"><?=get_currency_name($this->config->item('default_currency'));?></span>&nbsp;<?=format_price($value['subtotal']);?></td>
                            </tr>
                            <? endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td class="total_sum_label right"><?=lang('product-price-total');?>:</td>
                                <? if(isset($cart_discount) && $cart_discount) : ?>
                                <td class="currency  right"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<span class="without_discount_sum"><?=format_price($this->cart->total());?></span> <span class="discount_sum"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($discount_price);?></span></td>
                                <? else : ?>
                                <td class="currency total_sum right"><nobr><?=format_price($this->cart->total());?> <span class="currency_sign"><?=get_currency_name($this->config->item('default_currency'));?></span></nobr></td>
                                <? endif; ?>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <?=form_open(base_url('checkout')); ?>
                
                    <div class="inp_block">
                        <div class="label"><?=lang('cart-first-name');?></div>
                        <div class="check_inp"><?=form_input(array('name' => 'first_name', 'value' => set_value('first_name')))?>
                        <?=form_error('first_name','<div class="error">','</div>'); ?></div>
                    </div>
    
                    <div class="inp_block">
                        <div class="label"><?=lang('cart-surname');?></div>
                        <div class="check_inp"><?=form_input(array('name' => 'last_name', 'value' => set_value('last_name')))?>
                        <?=form_error('last_name','<div class="error">','</div>'); ?></div>
                    </div>
                    
                    <div class="inp_block">
                        <div class="label"><?=lang('cart-email');?></div>
                        <div class="check_inp"><?=form_input(array('name' => 'email', 'value' => set_value('email')))?>
                        <?=form_error('email','<div class="error">','</div>'); ?></div>
                    </div>
                    
                    <div class="inp_block">
                        <div class="label"><?=lang('cart-phone');?></div>
                        <div class="check_inp"><?=form_input(array('name' => 'phone', 'value' => set_value('phone')))?>
                        <?=form_error('phone','<div class="error">','</div>'); ?></div>
                    </div>
                    
                    <div class="inp_block">
                        <div class="label"><?=lang('cart-address');?></div>
                        <div class="check_inp"><?=form_input(array('name' => 'adress', 'value' => set_value('adress')))?>
                        <?=form_error('adress','<div class="error">','</div>'); ?></div>
                    </div>

                    <div class="inp_block">
                        <div class="label"><?=lang('cart-country');?></div>
                        <div class="check_inp">
                            <div class="choose-country">
                            <select name="country" class="chosen-select-deselect" data-placeholder=" ">
                                <option></option>
                                <? foreach($country_list as $value) : ?>
                                <option value="<?=$value['idCountry'];?>" <?=set_select('country', $value['idCountry'], FALSE);?>><?=$value['country_name'];?></option>
                                <? endforeach; ?>
                            </select>
                            </div>
                            <div class="clear"></div>
                            <?=form_error('country','<div class="error">','</div>'); ?>
                        </div>
                    </div>
                    
                    <div class="inp_block">
                        <div class="label"><?=lang('cart-city');?></div>
                        <div class="check_inp"><?=form_input(array('name' => 'city', 'value' => set_value('city')))?>
                        <?=form_error('city','<div class="error">','</div>'); ?></div>
                    </div>
                    
                    <div class="inp_block">
                        <div class="label"><?=lang('cart-zip');?></div>
                        <div class="check_inp"><?=form_input(array('name' => 'zip', 'value' => set_value('zip')))?>
                        <?=form_error('zip','<div class="error">','</div>'); ?></div>
                    </div>
    
                    <?=form_submit(array('name' => 'send', 'value' => lang('cart-send-checkout'), 'class' => 'check_btn'));?>
                    
                <?=form_close();?>
			</div>
        </div>    
    </div>
    
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