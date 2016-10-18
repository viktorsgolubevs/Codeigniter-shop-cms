<html>
<head>
    <title><?=$this->lang->line('order');?> #<?=$order_data['idOrder'];?></title>
</head>
<body style="font-family: Arial, Sans-serif; background: #ffffff; color: #444444; font-weight: 300; font-size: 13px;">
    <div class="order-print-container">

        <div class="order-data">
            
            <div style="float: right; margin: 0 20px 15px 20px;">
            
                <h1 style="text-transform: uppercase; text-align: right; margin-bottom: 20px; font-size: 30px;"><?=lang('order-invoice');?></h1>
            
                <div><strong style="min-width: 160px; display: inline-block;"><?=lang('order');?> #: </strong><?=$order_data['idOrder'];?></div>
                
                <br />
                
                <div><strong style="min-width: 160px; display: inline-block;"><?=lang('order-name');?>:</strong><?=$order_data['first_name'] . '&nbsp;' . $order_data['last_name'];?></div>
                <div><strong style="min-width: 160px; display: inline-block;"><?=lang('order-email');?>:</strong><?=$order_data['email'];?></div>
                <div><strong style="min-width: 160px; display: inline-block;"><?=lang('order-phone');?>:</strong><?=$order_data['phone'];?></div>
                <div><strong style="min-width: 160px; display: inline-block;"><?=lang('order-address');?>:</strong><?=$order_data['adress'];?></div>
                <div><strong style="min-width: 160px; display: inline-block;"><?=lang('order-country');?>:</strong><?=$order_data['country_name'];?></div>
                <div><strong style="min-width: 160px; display: inline-block;"><?=lang('order-zip');?>:</strong><?=$order_data['zip'];?></div>
                
                <br />
                
                <div><strong style="min-width: 160px; display: inline-block;"><?=lang('order-date');?>:</strong><?=date('d M Y', strtotime($order_data['created']));?></div>
            </div>
            
            <div style="clear: both;"></div>
            
            <div class="order-data-table bottom-30">
                <table style="border: 1px solid #cfd9db; font-size: 13px; width: 100%; border-collapse: collapse;">
                    <thead style="border-bottom: 2px solid #cfd9db; background-color: #f9f9f9; color: #5e5e5e; font-weight: 600;  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);">
                        <tr>
                            <th width="15" style="padding: 3px 6px;"><?=lang('order-item');?></th>
                            <th width="70" style="padding: 3px 6px;"><?=lang('order-image');?></th>
                            <th width="10%" style="padding: 3px 6px; text-align: left"><?=lang('product-code');?></th>
                            <th width="15%" style="padding: 3px 6px; text-align: right"><?=lang('order-name');?></th>
                            <th style="padding: 3px 6px; text-align: right"><?=lang('product-price');?></th>
                            <th width="15%" style="padding: 3px 6px; text-align: right"><?=lang('product-quantity');?></th>
                            <th width="20%" style="padding: 3px 6px; text-align: right"><?=lang('order-amount');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <? $num = 1; ?>
                        <? foreach ($order_product_data as $value) : ?>
                        <tr>
                            <td style="padding: 3px 6px; text-align: left;">1</td>
                            <td>
                                <? if (!empty($value['image'])) : ?>
                                <img src="<?=site_url($this->config->item('trumb2_location').$value['image']);?>" alt="" title=""/>
                                <? endif; ?>
                            </td>
                            <td style="padding: 3px 6px; text-align: left;"><?=$value['product_code'];?></td>
                            <td style="padding: 3px 6px; text-align: right;"><?=$value['name'];?></td>
                            <td style="padding: 3px 6px; text-align: right;"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($value['price']);?></td>
                            <td style="padding: 3px 6px; text-align: right;"><?=$value['quantity'];?></td>
                            <td style="padding: 3px 6px; text-align: right;"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($value['total_price']);?></td>
                        </tr>
                        <? $num++; ?>
                        <? endforeach; ?>                                          
                    </tbody>
                    <tfoot style="border: 1px solid #cfd9db; font-size: 13px; width: 100%; border-collapse: collapse;">
                        <tr>
                            <td colspan="5"></td>
                            <td style="border: 1px solid #cfd9db; padding: 8px; text-align: right; font-size: 14px;"><strong><?=lang('order-subtotal');?></strong></td>
                            <td style="border: 1px solid #cfd9db; padding: 8px; text-align: right; font-size: 14px;"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($order_data['order_total_price']);?></td>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                            <td style="border: 1px solid #cfd9db; padding: 8px; text-align: right; font-size: 14px;"><strong><?=lang('order-discount');?></strong></td>
                            <td style="border: 1px solid #cfd9db; padding: 8px; text-align: right; font-size: 14px;"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($order_data['discount_price']);?></td>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                            <td style="border: 1px solid #cfd9db; padding: 8px; text-align: right; font-size: 14px;"><strong><?=lang('order-tax');?></strong></td>
                            <td style="border: 1px solid #cfd9db; padding: 8px; text-align: right; font-size: 14px;"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=get_price_tax_back($order_data['order_total_price']-$order_data['discount_price']);?></td>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                            <td style="border: 1px solid #cfd9db; padding: 8px; text-align: right; font-size: 14px; background-color: #eaedee"><strong><?=lang('product-price-total');?></strong></td>
                            <td style="border: 1px solid #cfd9db; padding: 8px; text-align: right; font-size: 14px; background-color: #eaedee"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($order_data['order_total_price']-$order_data['discount_price']);?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
</body>
</html>