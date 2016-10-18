    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('orders');?><span><?=lang('order-one');?></span></h2></div>
    
            <div class="order-drop-container right">
                <div class="order-trigger"><?=lang('order-cancel');?></div>
                <div class="order-drop">
                    <a href="<?=site_url('back_end/order_delete/'.$order_data['idOrder']);?>"><?=lang('order-delete');?></a>
                </div>
            </div>
          
            <div class="order-drop-container right">
                <div class="order-trigger"><?=lang('order-options');?></div>
                <div class="order-drop">
                    <a href="<?=site_url('back_end/order_print_preview/'.$order_data['idOrder']);?>" target="_blank"><?=lang('order-print');?></a>
                </div>
            </div>
    
            <div class="order-drop-container right">
                <div class="order-trigger"><?=lang('order-payment-status');?></div>
                <div class="order-drop">
                    <? foreach ($payment_status as $value) : ?>
                    <a href="<?=site_url('back_end/payment_status/'.$order_data['idOrder'].'/'.$value['id']);?>" <? if(isset($value['checked'])) : ?>class="selected"<? endif; ?>><?=$value['lang'];?><? if(isset($value['checked'])) : ?><span class="checked-icon"></span><? endif; ?></a>
                    <? endforeach; ?>
                </div>
            </div>
    
            <div class="order-drop-container right">
                <div class="order-trigger"><?=lang('order-order-status');?></div>
                <div class="order-drop">
                    <? foreach ($order_status as $value) : ?>
                    <a href="<?=site_url('back_end/order_status/'.$order_data['idOrder'].'/'.$value['id']);?>" <? if(isset($value['checked'])) : ?>class="selected"<? endif; ?>><?=$value['lang'];?><? if(isset($value['checked'])) : ?><span class="checked-icon"></span><? endif; ?></a>
                    <? endforeach; ?>
                </div>
            </div>
                    
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header">
                    <span><?=lang('order-one');?> <abbr title="Order number">ID</abbr>:  <?=$order_data['idOrder'];?></span>
                </div>
                
                <div class="content_body order">
                    
                    <div class="order-data">
                        <div class="left personal-block">
                            <div><strong><?=lang('order-email');?>:</strong><?=$order_data['email'];?></div>
                            <div><strong><?=lang('order-one');?>:</strong><?=date($this->config->item('date-simple'), strtotime($order_data['created']));?></div>
                        </div>
                        
                        <div class="right personal-block">
                            <div><h4 class="subtitle text-right"><?=lang('order-shipping-adress');?></h4></div>
                            <div><strong><?=lang('order-name');?>:</strong><?=$order_data['first_name'] . ' ' . $order_data['last_name'];?></div>
                            <div><strong><?=lang('order-phone');?>:</strong><?=$order_data['phone'];?></div>
                            <div><strong><?=lang('order-address');?>:</strong><?=$order_data['adress'];?></div>
                            <div><strong><?=lang('order-country');?>:</strong><?=$order_data['country_name'];?></div>
                            <div><strong><?=lang('order-zip');?>:</strong><?=$order_data['zip'];?></div>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="order-data-table bottom-30">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-right"><?=lang('order-price');?></th>
                                    <th class="text-right" ><?=lang('order-discount-coupon');?></th>
                                    <th class="text-right"><?=lang('order-discount-price');?></th>
                                    <th class="text-right"><?=lang('order-total-price');?> <abbr title="<?=lang('order-total-price-caption');?>">?</abbr></th>
                                    <th class="text-right"><?=lang('order-tax');?></th>
                                    <th class="text-right"><?=lang('order-order-status');?></th>
                                    <th class="text-right"><?=lang('order-payment-status');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-right"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($order_data['order_total_price']);?></td>
                                    <td class="text-right"><?=!empty($order_data['discount_name']) ? $order_data['discount_name'] : '-';?></td>
                                    <td class="text-right"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($order_data['discount_price']);?></td>
                                    <td class="text-right"><strong><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($order_data['order_total_price']-$order_data['discount_price']);?></strong></td>
                                    <td class="text-right"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=get_price_tax_back($order_data['order_total_price']-$order_data['discount_price']);?></td>
                                    <td class="text-right"><?=$order_data['order_status_txt'];?></td>
                                    <td class="text-right"><?=$order_data['payment_status_txt'];?></td>
                                </tr>                        
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="order-data-table">
                        <table>
                            <thead>
                                <tr>
                                    <th width="75"><?=lang('image');?></th>
                                    <th class="text-left"><?=lang('code');?></th>
                                    <th class="text-left"><?=lang('product-name');?></th>
                                    <th class="text-right"><?=lang('product-price');?></th>
                                    <th class="text-right"><?=lang('product-quantity');?></th>
                                    <th class="text-right"><?=lang('product-total-price');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach ($order_product_data as $value) : ?>
                                <tr>
                                    <td>
                                        <? if (!empty($value['image'])) : ?>
                                        <img src="<?=site_url($this->config->item('trumb2_location').$value['image']);?>" alt="" title=""/>
                                        <? endif; ?>
                                    </td>
                                    <td><?=$value['product_code'];?></td>
                                    <td><?=$value['name'];?></td>
                                    <td class="text-right"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($value['price']);?></td>
                                    <td class="text-right"><?=$value['quantity'];?></td>
                                    <td class="text-right"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($value['total_price']);?></td>
                                </tr>
                                <? endforeach; ?>                      
                            </tbody>
                        </table>
                    </div>
        
                </div>
            </div>
        </div>
    </div>

</div> <!-- Page wrapper end -->

</body>
</html>