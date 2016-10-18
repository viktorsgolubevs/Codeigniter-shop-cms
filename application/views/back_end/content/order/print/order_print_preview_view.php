<html>
<head>
    <title><?=lang('order-one');?> #<?=$order_data['idOrder'];?> - <?=lang('print-preview');?></title>
    <link href="<?=site_url($this->config->item('css_back_end') . 'print_order.css');?>" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="order-print-container">

        <div class="order-data">
            
            <div class="right personal-block">
            
                <h1><?=lang('order-invoice');?></h1>
            
                <div><strong><?=lang('order-one');?> #: </strong><?=$order_data['idOrder'];?></div>
                
                <br />
                
                <div><strong><?=lang('order-name');?>:</strong><?=$order_data['first_name'] . '&nbsp;' . $order_data['last_name'];?></div>
                <div><strong><?=lang('order-email');?>:</strong><?=$order_data['email'];?></div>
                <div><strong><?=lang('order-phone');?>:</strong><?=$order_data['phone'];?></div>
                <div><strong><?=lang('order-address');?>:</strong><?=$order_data['adress'];?></div>
                <div><strong><?=lang('order-country');?>:</strong><?=$order_data['country_name'];?></div>
                <div><strong><?=lang('order-zip');?>:</strong><?=$order_data['zip'];?></div>
                
                <br />
                
                <div><strong><?=lang('order-date');?>:</strong><?=date('d M Y', strtotime($order_data['created']));?></div>
            </div>
            
            <div class="clear"></div>
            
            <div class="order-data-table bottom-30">
                <table>
                    <thead>
                        <tr>
                            <th class="text-left" width="15"><?=lang('order-item');?></th>
                            <th width="75"><?=lang('image');?></th>
                            <th class="text-left" width="10%"><?=lang('code');?></th>
                            <th class="text-right" width="20%"><?=lang('order-name');?></th>
                            <th class="text-right"><?=lang('product-price');?></th>
                            <th class="text-right" width="10%"><?=lang('product-quantity');?></th>
                            <th class="text-right" width="15%"><?=lang('order-amount');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <? $num = 1; ?>
                        <? foreach ($order_product_data as $value) : ?>
                        <tr>
                            <td><?=$num;?></td>
                            <td>
                                <? if (!empty($value['image'])) : ?>
                                <img src="<?=site_url($this->config->item('trumb2_location').$value['image']);?>" alt="" title=""/>
                                <? endif; ?>
                            </td>
                            <td><?=$value['product_code'];?></td>
                            <td class="text-right"><?=$value['name'];?></td>
                            <td class="text-right"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($value['price']);?></td>
                            <td class="text-right"><?=$value['quantity'];?></td>
                            <td class="text-right"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($value['total_price']);?></td>
                        </tr>
                        <? $num++; ?>
                        <? endforeach; ?>                       
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5"></td>
                            <td class="fn"><strong><?=lang('order-subtotal');?></strong></td>
                            <td class="fn"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($order_data['order_total_price']);?></td>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                            <td class="fn"><strong><?=lang('order-discount');?></strong></td>
                            <td class="fn"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($order_data['discount_price']);?></td>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                            <td class="fn"><strong><?=lang('order-tax');?></strong></td>
                            <td class="fn"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=get_price_tax_back($order_data['order_total_price']-$order_data['discount_price']);?></td>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                            <td class="fn bg"><strong><?=lang('product-total-price');?></strong></td>
                            <td class="fn bg"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($order_data['order_total_price']-$order_data['discount_price']);?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
</body>
</html>