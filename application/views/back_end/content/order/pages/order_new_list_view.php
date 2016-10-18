    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('orders');?><span><?=lang('order-new');?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header"><span><?=lang('order-list');?></span></div>
                <div class="content_body">
    
                    <? if (isset($order_data) && empty($order_data)) : ?>
                    
                    <div class="block_attention"><?=lang('order-error-no-order');?></div>
                    
                    <? else: ?>
                
                    <div class="table">
                        <table id="order_list">
                            <thead>
                                <tr>
                                    <th><?=lang('order-date');?></th>
                                    <th><?=lang('order-id');?></th>
                                    <th><?=lang('order-amount');?></th>
                                    <th><?=lang('order-status');?></th>
                                    <th><?=lang('order-payment-status');?></th>
                                    <th><?=lang('action');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach($order_data as $value) : ?>
                                <tr>
                                    <td class="center"><?=date('d M Y', strtotime($value['created']));?></td>
                                    <td class="center"><?=$value['idOrder'];?></td>
                                    <td class="left-column-margin"><?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($value['order_total_price']-$value['discount_price']);?></td>
                                    <td class="center"><?=$value['order_status_txt'];?></td>
                                    <td class="center"><?=$value['payment_status_txt'];?></td>
                                    <td class="center">
                                        <a href="<?=base_url('back_end/order_show/'.$value['idOrder']);?>"><img src="<?=site_url('assets/img/icons/icon_read.png');?>" alt="<?=lang('open');?>" title="<?=lang('open');?>"/></a>
                                    </td>
                                </tr>
                                <? endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><?=lang('order-date');?></td>
                                    <td><?=lang('order-id');?></td>
                                    <td><?=lang('order-amount');?></td>
                                    <td><?=lang('order-status');?></td>
                                    <td><?=lang('order-payment-status');?></td>
                                    <td> &nbsp; </td>
                                </tr>
                            </tfoot>
                        </table>        
                    </div>
                    
                    <? endif; ?>
        
                </div>
            </div>
        </div>
    </div>
    
</div> <!-- Page wrapper end -->

</body>
</html>