    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('orders');?><span><?=lang('orders-monthly');?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header"><span><?=lang('order-list');?></span></div>
                <div class="content_body">
    
                    <div class="order-search-block">
                        
                        <?=form_open(uri_string()); ?>
                            
                            <div class="txt-label left"><?=lang('order-month-label');?>:</div>
                            
                            <div class="input_block select-month left">
                                <div class="left_field">
                                    <select name="order_month" class="form_control sz1 chosen-select-deselect" data-placeholder="Choose a category">
                                        <? foreach ($months as $value) : ?>
                                        
                                        <? if ($_POST) : ?>
                                        
                                            <? if (isset($_POST['order_month']) && $_POST['order_month'] == $value['month']) : ?>
                                            <option value="<?=$value['month'];?>" selected><?=$value['month'];?></option>
                                            <? else : ?>
                                            <option value="<?=$value['month'];?>"><?=$value['month'];?></option>
                                            <? endif; ?>
                                        
                                        <? else : ?>
                                        
                                            <? if (isset($value['selected'])) : ?>
                                            <option value="<?=$value['month'];?>" selected><?=$value['month'];?></option>
                                            <? else : ?>
                                            <option value="<?=$value['month'];?>"><?=$value['month'];?></option>
                                            <? endif; ?>
                                        
                                        <? endif; ?>
                                        
                                        <? endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="input_block select-year left">
                                <div class="left_field">
                                    <select name="order_year" class="form_control sz1 chosen-select-deselect" data-placeholder="Choose a category">
                                        <? foreach ($years as $value) : ?>
                                        
                                        <? if ($_POST) : ?>

                                            <? if (isset($_POST['order_year']) && $_POST['order_year'] == $value['year']) : ?>
                                            <option value="<?=$value['year'];?>" selected><?=$value['year'];?></option>
                                            <? else : ?>
                                            <option value="<?=$value['year'];?>"><?=$value['year'];?></option>
                                            <? endif; ?>

                                        <? else : ?>
                                        
                                            <? if (isset($value['selected'])) : ?>
                                            <option value="<?=$value['year'];?>" selected><?=$value['year'];?></option>
                                            <? else : ?>
                                            <option value="<?=$value['year'];?>"><?=$value['year'];?></option>
                                            <? endif; ?>
                                        
                                        <? endif; ?>
                                        
                                        <? endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            
                            <?=form_submit(array('name' => '', 'value' => lang('show'), 'class' => 'btn btn-blue'));?>
                            
                            <div class="clear"></div>
                        
                        <?=form_close();?>
                        
                    </div>
    
                    <? if (isset($order_data)) : ?>
    
                    <? if (empty($order_data)) : ?>
                    
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
                    
                    <? endif; ?>
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