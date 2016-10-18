    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('coupons');?><span><?=lang('coupon-edit');?> - <?=$coupon_data['coupon_code'];?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header">
                    <ul>
                        <li><a href="<?=site_url('back_end/coupon_list');?>"><?=lang('coupon-list');?></a></li>
                        <li class="active"><?=lang('coupon-edit');?></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="content_body">
                    <?=form_open(uri_string()); ?>
                            
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('coupon-code');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'coupon_code', 'value' => $coupon_data['coupon_code'], 'class' => 'form_control sz1'))?>
                                    <?=form_error('coupon_code','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('coupon-discount-option');?>:</span></div>
                                <div class="input_block">
                                    <label>
                                    <? if ($coupon_data['discount_type'] == '1'): ?>
                                    <?=form_radio(array('name' => 'discount_type', 'value' => 1, 'checked' => 'checked'));?>
                                    <? else : ?>
                                    <?=form_radio(array('name' => 'discount_type', 'value' => 1));?>
                                    <? endif; ?>
                                    &nbsp;%</label><br />
                                    
                                    <label>
                                    <? if ($coupon_data['discount_type'] == '2'): ?>
                                    <?=form_radio(array('name' => 'discount_type', 'value' => 2, 'checked' => 'checked'));?>
                                    <? else : ?>
                                    <?=form_radio(array('name' => 'discount_type', 'value' => 2));?>
                                    <? endif; ?>
                                    &nbsp;<?=get_currency_name($this->config->item('default_currency'));?></label>
                                    <?=form_error('discount_type','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                            
                            <div class="input_separator"></div>
                            
                            <div class="block">
                                <div class="control-label"><span><?=lang('discount');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'discount', 'value' => $coupon_data['discount'], 'class' => 'form_control sz1'))?>
                                    <?=form_error('discount','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('coupon-minimal-order');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'min_order', 'value' => $coupon_data['min_order'], 'class' => 'form_control sz1'))?>
                                    <?=form_error('min_order','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="footer-button-group-container">
                            <div class="button-group-block">
                                <div class="button-position">
                                    <?=form_submit(array('name' => 'add_coupon', 'value' => lang('edit'), 'class' => 'btn btn-blue'));?>
                                    <a href="<?=site_url('back_end/coupon_list');?>" class="btn btn-gray"><?=lang('back');?></a>
                                </div>
                            </div>
                        </div>
                        
                    <?=form_close();?>
                </div>
            </div>
        </div>
    </div>
    
</div>

</body>
</html>